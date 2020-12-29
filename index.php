<?php
declare(strict_types=1);
ini_set('display_errors', "1");
ini_set("error_reporting", "32767");

class some_test
{

    public function __construct(
        private string $first = "potato",
        public string | null $second,      //union型
        public string $third,      //このコンマが可能になった
        )
    {}

    public function __get(string $name) :string | null
    {
        return $this->{$name} ?? throw new LogicException($name ." does not exists", 500);      //throw"式"
    }

}


try{
    /*
    $test = new some_test(first: "banana", "kiwi");
    名前付き引数の前に通常の引数は置けんのでアウト

    $test = new some_test("kiwi", first: "banana");
    一番目と二番目の引数がともに$firstに向いているのでアウト
    */

    $test = new some_test("kiwi", third: "1234", second: null);  //このコンマも可能になった
    echo $test->first."<br>";
    echo gettype($test->second)."<br>";
    echo $test->third."<br>";

    $result = match(true){
        (int) $test->third > 100 => "lv.100",
        (int) $test->third > 10  => "lv.10",
        (int) $test->third > 0  => "lv.0",
    };          //式なのでセミコロンで閉じる
    
    var_dump($result);
    


}catch(Throwable $e){
    echo "<pre>";
    var_dump($e);
    echo "</pre>";
}





?>
