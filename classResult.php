<?
class Result
{
    private $stmt = null;
    private $res = null;
    private $result = array();
    private $data = array();
    private $params = array();

    public function __construct($mysqli, $arr, $arrColumn, $query)
    {
        $this->stmt = $mysqli->stmt_init();
        try {
            $this->prepare($query);
            if (count($arr) > 0){
                $this->bind($arr);
            }
            $this->execute();
            $this->attachResult($arrColumn);
            $this->store();
            $this->fetch($arrColumn);
            $this->free();
            $this->close();

        } catch (Exception $e) {
            Debug.log('Select Error (' . $this->stmt->errno . ') ' . $this->stmt->error);
        }
    }
    // подготовливаем запрос, там куда будут вствлятся данные отмечаем символом ? (плейсхолдоры)
    private function prepare($query)
    {
        $this->stmt->prepare($query);
    }
    // привязываем переменные к плейсхолдорам
    //i (int), d (double), s (string), b (blob)
    private function bind($arr)
    {
        call_user_func_array(array($this->stmt, "bind_param"), $this->refValues($arr)) ;
    }
    //подгоняем массив
    public function refValues($arr){
        if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
        {
            $refs = array();
            foreach($arr as $key => $value)
                $refs[$key] = &$arr[$key];
            return $refs;
        }
        return $arr;
    }
    // отрправляем даные, которые на данный момент находятся в привязанных переменных
    private function execute()
    {
        $this->stmt->execute();
    }
    // привязывем переменую для получения в нее результата
    private function attachResult($arrColumn)
    {
        /* // В дальнейшем использовать для модификации,
           // чтобы не вводить поля, в которые сохранятся
            # of fields in result set.
            $nof = mysqli_num_fields( mysqli_stmt_result_metadata($handle) );
            # The metadata of all fields
            $fieldMeta = mysqli_fetch_fields( mysqli_stmt_result_metadata($handle) );
            # convert it to a normal array just containing the field names
            $fields = array();
            for($i=0; $i < $nof; $i++)
                $fields[$i] = $fieldMeta[$i]->name;
        */
        //создаём массив ключ (набор своих колонок) => значение (выбранные значения из БД)
        foreach($arrColumn as $col_name)
        {
            // Assign the fetched value to the variable '$data[$name]'
            $this->params[$col_name] = &$this->data[$col_name] ;
        }
        //вызываем callback и передаём туда массив
        $this->res = call_user_func_array(array($this->stmt, "bind_result"),  $this->params);

    }
    // делаем запрос буферизированным,
    // если бы этой строки не было, запрос был бы небуферезированым
    private function store()
    {
        $this->stmt->store_result();
    }
    // получение результата из привязанной переменной
    public function fetch($arrColumn)
    {
        $copy = create_function('$a', 'return $a;');
        if($this->res)
        {
            while($this->stmt->fetch()){
                $this->result[] = array_combine($arrColumn, array_map($copy, $this->params) );
            }
        }
    }
    private function close()
    {
        $this->stmt->close();
    }
    private function  free()
    {
        $this->stmt->free_result();
    }
    public function getResult()
    {
        return $this->result;
    }
    public function getJSON()
    {
        return json_encode($this->result);
    }
}
?>