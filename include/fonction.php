<?php 
function dbconnect()
{
    static $connect = null;
    if ($connect === null) {
        $connect = mysqli_connect('localhost', 'root', '', 'employees');
        if (!$connect) {
            die('Erreur de connexion a la base de donnees: ' . mysqli_connect_error());
        }
        mysqli_set_charset($connect, 'utf8mb4');
    }
    return $connect;
}
function get_all_line($sql) {
    $req=mysqli_query(dbconnect(),$sql);
    $result=array();
    while ($line = mysqli_fetch_array($req)) {
        $result[]=$line;
    }
    mysqli_free_result($req);
    return $result;
}
function get_one_line($sql) {
    $req=mysqli_query(dbconnect(),$sql);
    $result=mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $result;
}

function get_employees_by_dept($dept_no){
    $sql = "select empl.first_name, empl.last_name ,empl.emp_no
    from departments as dep
    join dept_emp
    on dep.dept_no = dept_emp.dept_no
    join employees as empl
    on dept_emp.emp_no = empl.emp_no
    where dep.dept_no = '%s'";
    $sql = sprintf($sql, $dept_no);
    return get_all_line($sql);
}

function get_fiche_employees($emp_no) {
$sql= "select*from employees where emp_no = '%s'";
$sql = sprintf($sql, $emp_no);
$new_req=mysqli_query(dbconnect(),$sql);
$result=mysqli_fetch_assoc($new_req);
mysqli_free_result($new_req);
return $result;
}
function get_historique_employees($emp_no) {
    $sql="select sal.salary, sal.from_date, sal.to_date from employees as empl
    join salaries as sal
    on empl.emp_no=sal.emp_no
    where empl.emp_no = '%s'";
    $sql = sprintf($sql, $emp_no);
    return get_all_line($sql);
}

function get_historique_poste($emp_no) {
     $sql="select tit.title,tit.from_date as tit_from,tit.to_date as tit_to from employees as empl
    join titles as tit
    on empl.emp_no=tit.emp_no
    where empl.emp_no = '%s'";
    $sql = sprintf($sql, $emp_no);
    return get_all_line($sql);
}



