<?php
class People{
    protected $name = 'Duong';
    const number = 'hang_so';
}
class Student extends People {
    public function getName(){
        return $this->name;
    }
}
$printName = new Student;
echo Student::number;
echo $printName->getName();
//<p>Bạn có chắc chắn muốn xóa sản phẩm <p style="color: red">${productName}?</p></p>
//                   <p style="color: red">sản phẩm sẽ bị xóa vĩnh viễn</p>
//                   <button class="btn-confirm">Xác nhận</button>
//                   <button class="btn-cancel-new">Hủy</button>
