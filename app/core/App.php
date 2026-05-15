<?php
class App 
{

    protected $controller = 'home'
    protected $action
    public function_construct()
    {
       // if (isset($GET['url'])){
       // echo($_GET['url']);
        //}
         //tạo ra 1 biến chạy UrlProcess() đưa ra màn hình
        $urlProcessed = $this->UrlProcess();// mảng url đã chọn
       // var_dump($urlProcessed)
       if(isset($urlProcessed[0])) {
        if(file_exists('../app/controllers/' . $urlProcessed[0] . 'Controller.php'))
            $this->controller = $urlProcessed[0];
            unset($urlProcessed[0]);
       }
    }
    //xử lý cho action
    require_once '../app/cpntroller/' . $this->controller . 'Controller.php' ;
    $this->controller = new $this->controller; //tạo đối trượng controller
    if(isset($urlProcessed[1])){
        if (method_exists($this->controller, $urlProcessed[1])){
            $this->action = $urlProcessed[1];
            unset($urlProcessed[1]);
        }
    }

    $this->params = $urlProcessed ? array_values($urlProcessed//xử lý các phần tử còn lại nếu có
    public function UrlProcess(){
        if (isset($_GET['url'])){
     // dùng trim loại bỏ dâu / ở đầu và cuối; nếu không có sẽ pum liên tục và sẽ đưa ra url có kí tự trước và sau dấu /
            return explode('/', filter_var(trim($_GET['url'], '/')));
        
        }
    }
}






?>