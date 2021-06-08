<?php

/**
 * Class Dispatcher
 * uriに従ってコントロータとアクションを振り分ける
 */
class Dispatcher
{
    const CONTROLLER_DIR = 'src/view/Controller' . DIRECTORY_SEPARATOR;

    // コントローラファイルへのパス
    private $controller_path;

    // 設定ファイルを正規表現の形にしたものが入る
    private $patterns;

    // コントローラ名
    private $controller;

    // アクション名 ex.) indexAction
    private $action;

    // アクションに渡される引数 ex.) $args['name']
    private $args;

    // リクエストがあったURI
    private $request_uri;

    /**
     * コンストラクタでルーティングの初期設定を行う
     *
     * @param string[] $routes
     */
    public function __construct($routes)
    {
        $this->controller_path = ROOT . self::CONTROLLER_DIR;
        $this->patterns = $this->setPatterns($routes);
        if ($this->resolve() === false) {
            $this->controller = $routes[DIRECTORY_SEPARATOR]['controller'];
            $this->action = $routes[DIRECTORY_SEPARATOR]['action'];
        }
    }

    /**
     * 正規表現に変換する。ex.) {action} -> (?P<action>[^/]+)
     *
     * @param string $route
     * @return string 正規表現の文字列
     *
     */
    private function tokenToRegexp($route)
    {
        if (preg_match('/{(.+?)}/', $route, $matches)) {
            $route = "(?P<{$matches[1]}>[^/]+)";
        }
        return $route;
    }

    /**
     * ルーティングURLを正規表現に変換する
     * ex.) /{name} -> /(?P<name>[^/]+)
     *
     * @param string[] $route
     * @return string[] ルーティングの対応を示す配列
     */
    private function setPatterns($routes)
    {
        $patterns = [];

        foreach ($routes as $url => $route) {
            $url = rtrim($url, DIRECTORY_SEPARATOR);
            $url = ltrim($url, DIRECTORY_SEPARATOR);
            $tokens = explode(DIRECTORY_SEPARATOR, $url);
            $tokens = array_map([$this, 'tokenToRegexp'], $tokens);

            $pattern = DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $tokens);
            $patterns[$pattern] = $route;
        }
        return $patterns;
    }

    /**
     * URLとルーティングパターンからコントローラ、アクション、引数を決める
     *
     * @return bool
     */
    public function resolve()
    {
        // リクエストURIの末尾の'/'を削除する。
        $this->request_uri = rtrim($_SERVER['REQUEST_URI'], DIRECTORY_SEPARATOR);

        if (DIRECTORY_SEPARATOR !== substr($this->request_uri, 0, 1)) {
            $this->request_uri = DIRECTORY_SEPARATOR . $this->request_uri;
        }

        foreach ($this->patterns as $pattern => $route) {
            if (preg_match('#^' . $pattern . '$#', $this->request_uri, $matches)) {
                $route = array_merge($route, $matches);
                $this->controller = $route['controller'];
                $this->action = $route['action'];

                unset($route['controller']);
                unset($route['action']);

                $this->args = $route;
                return true;
            }
        }
        return false;
    }

    public function getRequestUri()
    {
        return $this->request_uri;
    }

    /**
     * アクションを実行する
     */
    public function dispatch()
    {
        $controller_file = $this->controller_path . $this->controller . '.php';

        if (file_exists($controller_file) === false) {
            throw new InvalidArgumentException("{$controller_file}が存在しません。");
        }

        require_once $controller_file;

        $controller_instance = new $this->controller();
        $action_method = $this->action;

        if (method_exists($controller_instance, $action_method) === false) {
            throw new InvalidArgumentException("{$action_method}が存在しません。");
        }

        $controller_instance->$action_method($this->args);
    }
}
