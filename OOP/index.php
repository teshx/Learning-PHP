<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    class Newclass
    {

        //properties and mmethodes here
        public $name="tis is some info";
        //this is vissiible for all
        private $names="tis is some info";
         // only vissiblle for inside class
        protected $namess="tis is some info";

        //it is vissible for extended c;ass
        


    }


    
    $object = new Newclass();

    var_dump($object);

    ?>
</body>

</html>