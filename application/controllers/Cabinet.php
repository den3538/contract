<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabinet extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->load->library('session');
    }

    private function output($output = null)
    {
        $this->load->view('cabinet.php', (array)$output);
    }

    public function index()
    {
        redirect('cabinet/contract_management');
    }

    public function contract_management()
    {
        $crud = new grocery_CRUD();

        $crud->set_subject('Договор');
        $crud->set_table('contract');
        $crud->fields('cipher','name','client_id', 'kind_id', 'status_id', 'registration', 'note', 'amount', 'start', 'end', 'plan_date', 'pay_date');
        $crud->display_as('cipher', 'Код договора');
        $crud->display_as('client_id', 'Наименование клиента');
        $crud->display_as('pay_date', 'Дата оплаты');
        $crud->display_as('kind_id', 'Вид');
        $crud->display_as('status_id', 'Статус');
        $crud->display_as('name', 'Наименование');
        $crud->display_as('registration', 'Дата регистрации');
        $crud->display_as('note', 'Примечание');
        $crud->display_as('amount', 'Сумма(грн)');
        $crud->display_as('start', 'Дата начала');
        $crud->display_as('end', 'Дата окончания');
        $crud->display_as('plan_date', 'Крайний срок оплаты');
        $crud->display_as('pay_date', 'Дата оплаты');

        $crud->required_fields(['cipher', 'kind_id', 'stauts_id', 'name', 'registration', 'amount', 'start', 'end', 'plan_date']);
        $crud->set_relation('kind_id', 'kind', 'name');
        $crud->set_relation('client_id', 'counterparty', 'name');
        $crud->set_relation('status_id', 'status', 'name');
        $crud->columns('cipher','name','client_id','kind_id','registration', 'start', 'end','status_id','plan_date','pay_date','note','amount');

        $crud->getModel()->set_add_value('cipher', substr(hexdec(uniqid()), -7));

        $output = $crud->render();

        $this->output($output);
    }

    public function counterparty_management()
    {
        $crud = new grocery_CRUD();

        $crud->set_subject('Клиента');
        $crud->set_table('counterparty');
        $crud->display_as('id', 'Код клиента');
        $crud->display_as('full_name', 'ФИО');
        $crud->display_as('phone', 'Телефон');
        $crud->display_as('name', 'Наименование');
        $crud->display_as('bank', 'Банк');
        $crud->display_as('account', 'Расчетный счет');
        $crud->required_fields(['name', 'side', 'bank', 'account']);

        $crud->columns('id', 'name','full_name', 'phone', 'bank', 'account');

        if ($crud->getState() == 'edit' || $crud->getState() == 'read') {
            $id = $crud->getStateInfo()->primary_key;
            $this->load->model('Main_model', 'main');
            $data = $this->main->get($id);
            $crud->set_subject("Клиента - {$data->start} / {$data->end} ({$data->kind}) ");
        }
        $output = $crud->render();

        $this->output($output);
    }

    public function responsible_management()
    {
        $crud = new grocery_CRUD();

        $crud->set_subject('Работу');
        $crud->set_table('responsible');
        $crud->display_as('id', 'Код');
        $crud->display_as('contract_id', 'Номер - начало - окончание');
        $crud->display_as('staff_id', 'Сотрудник');
        $crud->display_as('note', 'Примечание');
        $crud->display_as('start', 'Дата начала');
        $crud->display_as('end', 'Дата окончания');
        $crud->set_relation('contract_id', 'contract', '{cipher} - {start} - {end}');
        $crud->set_relation('staff_id', 'staff', 'name');
        $crud->required_fields(['contract_id', 'staff_id', 'start', 'end']);
        $crud->columns('id','contract_id','staff_id','note','start','end');

        if ($crud->getState() == 'edit' || $crud->getState() == 'read') {
            $id = $crud->getStateInfo()->primary_key;
            $this->load->model('Main_model', 'main');
            $data = $this->main->get($id);
            $crud->set_subject("Работу - {$data->start} / {$data->end} ({$data->kind}) ");
        }
        $crud->unset_columns('responsibility_id');
        $output = $crud->render();

        $this->output($output);
    }

    public function staff_management()
    {
        $crud = new grocery_CRUD();

        $crud->set_subject('Сотрудника');
        $crud->set_table('staff');
        $crud->display_as('id', 'Код');
        $crud->display_as('post_id', 'Должность');
        $crud->display_as('name', 'ФИО');
        $crud->display_as('address', 'Адрес');
        $crud->display_as('phone', 'Телефон');
        $crud->display_as('salary', 'Оклад (₴)');
        $crud->set_relation('post_id', 'post', 'name');
        $crud->required_fields(['post_id', 'name', 'address', 'phone', 'salary']);
        $crud->columns('id','post_id','name','address','phone','salary');

        $output = $crud->render();

        $this->output($output);
    }


    public function client_report()
    {
        $this->load->view("test_view.php");
    }

    public function client_report_late(){
        $this->load->view("test_view_late.php");
    }
    public function work_report(){
        $this->load->view("work_view.php");
    }
    function encrypt_password_callback($post_array) {
        $temp = $post_array['contract_id'];
        $row = $this->db->from('contract')->where('cipher',$temp)->get()->result();
        $cipher = $row ? $row[0]->cipher : null;
        $row=$this->db->from('project')->where('contract_id',$post_array['contract_id'])->get();
        $fp = fopen("counter.txt", "a"); // Открываем файл в режиме записи
        $test = fwrite($fp, json_encode($row->result())); // Запись в файл
        if ($test) echo 'Данные в файл успешно занесены.';
        else echo 'Ошибка при записи в файл.';
        fclose($fp); //Закрытие файла
       if (!empty($row->result())){
           $this->session->set_flashdata('message', 'This is a message.');
           exit();
       }

        return $post_array;
    }

    public function test(){
        $temp = 643;
        $row=$this->db->from('contract')->where('cipher',$temp)->get()->result();
        die(var_dump(empty($row)));
    }
}