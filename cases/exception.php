<?php
require_once __DIR__ . '/../autoload.php';


class A {
    const NAME = 'A';
}

class B extends A{
    const NAME = 'B';
}

class c extends B{
    const NAME = 'C';
}
(new C())->getName(['app'=>'se vira nos 30']);
