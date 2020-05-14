<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_fee_report extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_table() {
        $table = "voucher_record";
        return $table;
    }

    function _get_cash_received_report($data){
        $this->db->select('cash_received.*,cash_received_details.*,outlet.*');
        $this->db->from('cash_received');
        $this->db->join("cash_received_details", "cash_received_details.c_r_id = cash_received.id", "full");
        $this->db->join("outlet", "outlet.id = cash_received.outlet_id", "full");
        $this->db->where('cash_received.outlet_id',$data['outlet_id']);
        $this->db->where('cash_received.fee_month >=', $data['from']);
        $this->db->where('cash_received.fee_month <=', $data['to']);
        $this->db->order_by('cash_received.fee_month desc');
        return $this->db->get();
    }

    function _get_teacher_payment_list_print($data) {
        $this->db->select('account_transaction.*,outlet.*,users.*');
        $this->db->from('account_transaction');
        $this->db->join("outlet", "outlet.id = account_transaction.outlet_id", "full");
        $this->db->join("users", "users.id = account_transaction.account_to_id", "full");
        $this->db->where('account_transaction.outlet_id',$data['outlet_id']);
        $this->db->where('account_transaction.account_to_id',$data['teacher_id']);
        $this->db->where('account_transaction.pay_month >=', $data['from_date']);
        $this->db->where('account_transaction.pay_month <=', $data['to_date']);
        $this->db->order_by('account_transaction.pay_month desc');
        return $this->db->get();
    }

    function _get_account_by_type($where1,$where){
        $table = 'account';
        $this->db->where($where1);
        $this->db->where($where);
        return $this->db->get($table);
    }

    function _get_employee_payment_list_print($data) {
        $this->db->select('account_transaction.*,outlet.*');
        $this->db->from('account_transaction');
        $this->db->join("outlet", "outlet.id = account_transaction.outlet_id", "full");
        $this->db->where('account_transaction.outlet_id',$data['outlet_id']);
        $this->db->where('account_transaction.account_to_id',$data['employee_id']);
        $this->db->where('account_transaction.pay_month >=', $data['from_date']);
        $this->db->where('account_transaction.pay_month <=', $data['to_date']);
        $this->db->order_by('account_transaction.pay_month desc');
        return $this->db->get();
    }

    function _get_section_fee_report_print($data) {
        $this->db->select('voucher_record.*,voucher_data.*,outlet.*');
        $this->db->from('voucher_record');
        $this->db->join("outlet", "outlet.id = voucher_record.outlet_id", "full");
        $this->db->join("voucher_data", "voucher_data.voucher_id = voucher_record.id", "full");
        $this->db->where('voucher_record.outlet_id',$data['outlet_id']);
        $this->db->where('voucher_record.section_id',$data['section_id']);
        $this->db->where('voucher_record.due_date >=', $data['from_date']);
        $this->db->where('voucher_record.due_date <=', $data['to_date']);
        $this->db->order_by('voucher_record.due_date desc');
        return $this->db->get();
    }

    function _get_unpaid_fee_report_print($data){
        $this->db->select('voucher_record.*,voucher_data.*,outlet.*');
        $this->db->from('voucher_record');
        $this->db->join("outlet", "outlet.id = voucher_record.outlet_id", "full");
        $this->db->join("voucher_data", "voucher_data.voucher_id = voucher_record.id and voucher_data.status = 0", "full");
        $this->db->where('voucher_record.outlet_id',$data['outlet_id']);
        $this->db->where('voucher_record.due_date >=', $data['from_date']);
        $this->db->where('voucher_record.due_date <=', $data['to_date']);
        $this->db->order_by('voucher_record.due_date desc');
        return $this->db->get();
    }

    function _get_paid_fee_report_print($data){
        $this->db->select('voucher_record.*,voucher_data.*,outlet.*');
        $this->db->from('voucher_record');
        $this->db->join("outlet", "outlet.id = voucher_record.outlet_id", "full");
        $this->db->join("voucher_data", "voucher_data.voucher_id = voucher_record.id and voucher_data.status = 1", "full");
        $this->db->where('voucher_record.outlet_id',$data['outlet_id']);
        $this->db->where('voucher_record.due_date >=', $data['from_date']);
        $this->db->where('voucher_record.due_date <=', $data['to_date']);
        $this->db->order_by('voucher_record.due_date desc');
        return $this->db->get();
    }

    function _get_teacher_total_payment($outlet_id){
        $table = 'account_transaction';
        $this->db->select_sum('amount');
        $this->db->where('account_to_type','Teacher');
        $this->db->where('outlet_id',$outlet_id);
        return $this->db->get($table);
    }

    function _get_employee_total_payment($outlet_id){
        $table = 'account';
        $this->db->select_sum('opening_balance');
        $this->db->where('type','Employee');
        $this->db->where('outlet_id',$outlet_id);
        return $this->db->get($table);
    }

    function _get_student_fee_report($data) {
        $this->db->select('cash_received_details.*,cash_received.*,outlet.*');
        $this->db->from('cash_received');
        $this->db->join("cash_received_details", "cash_received_details.c_r_id = cash_received.id", "full");
        $this->db->join("outlet", "outlet.id = cash_received.outlet_id", "full");
        $this->db->where('cash_received.outlet_id',$data['outlet_id']);
        $this->db->where('cash_received.fee_month >=', $data['from_date']);
        $this->db->where('cash_received.fee_month <=', $data['to_date']);
        $this->db->order_by('cash_received.fee_month desc');
        return $this->db->get();
    }

    function _get_student_test_print($data) {
        $this->db->select('test_marks.*,test.*,outlet.*');
        $this->db->from('test');
        $this->db->join("test_marks", "test.id = test_marks.test_id and test_marks.std_id =".$data['student_id'], "full");
        $this->db->join("outlet", "outlet.id = test_marks.outlet_id", "full");
        $this->db->where('test.outlet_id',$data['outlet_id']);
        // $this->db->where('test.test_date >=', $data['from_date']);
        // $this->db->where('test.test_date <=', $data['to_date']);
        $this->db->order_by('test.test_date desc');
        return $this->db->get();
    }

    function _get_teacher_pay_report1($data){
        $this->db->select('account_transaction.*,outlet.*,users.*,account_transaction.pay_month fee_month,users.full_name teacher_name');
        $this->db->from('account_transaction');
        $this->db->join("outlet", "outlet.id = account_transaction.outlet_id", "full");
        $this->db->join("users", "users.id = account_transaction.account_to_id", "full");
        $this->db->where('account_transaction.account_to_id',$data['teacher_id']);
        $this->db->where('account_transaction.outlet_id',$data['outlet_id']);
        $this->db->where('account_transaction.pay_month >=', $data['from_date']);
        $this->db->where('account_transaction.pay_month <=', $data['to_date']);
        $this->db->order_by('account_transaction.pay_month desc');
        return $this->db->get();
    }

    function _get_teacher_pay_report2($data) {
        $this->db->select('cash_received_details.*,cash_received.*,outlet.*,users.*');
        $this->db->from('cash_received');
        $this->db->join("cash_received_details", "cash_received_details.c_r_id = cash_received.id and cash_received_details.teacher_id = ".$data['teacher_id'], "full");
        $this->db->join("outlet", "outlet.id = cash_received.outlet_id", "full");
        $this->db->join("users", "users.id = cash_received_details.teacher_id", "full");
        $this->db->where('cash_received.outlet_id',$data['outlet_id']);
        $this->db->where('cash_received.fee_month >=', $data['from_date']);
        $this->db->where('cash_received.fee_month <=', $data['to_date']);
        $this->db->order_by('cash_received.fee_month desc');
        return $this->db->get();
    }

}