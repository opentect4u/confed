<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paddy extends CI_Model {

    public function f_get_particulars($table_name, $select=NULL, $where=NULL, $flag) {
        
        if(isset($select)) {

            $this->db->select($select);

        }

        if(isset($where)) {

            $this->db->where($where);

        }

        $result		=	$this->db->get($table_name);

        if($flag == 1) {

            return $result->row();
            
        }else {

            return $result->result();

        }

    }

    //For Where in Clause for employees
    public function f_get_particulars_in($table_name, $where_in=NULL, $where=NULL) {

        if(isset($where)){

            $this->db->where($where);

        }

        if(isset($where_in)){

            $this->db->where_in('sl_no', $where_in);

        }
        
        $result	=	$this->db->get($table_name);

        return $result->result();

    }

    public function f_get_distinct($table_name, $select=NULL, $where=NULL) {

        $this->db->distinct();

        if(isset($select)) {

            $this->db->select($select);

        }

        if(isset($where)) {

            $this->db->where($where);

        }

        $result		=	$this->db->get($table_name);

        return $result->result();
        
    }

    

    //For inserting row

    public function f_insert($table_name, $data_array) {

        $this->db->insert($table_name, $data_array);

        return;

    }

    //For Inserting Multiple Row

    public function f_insert_multiple($table_name, $data_array){

        $this->db->insert_batch($table_name, $data_array);

        return;

    }

    //For Editing row

    public function f_edit($table_name, $data_array, $where) {

        $this->db->where($where);
        $this->db->update($table_name, $data_array);

        return;

    }

    //For Deliting row

    public function f_delete($table_name, $where) {

        $this->db->delete($table_name, $where);

        return;

    }

    //For Report
    public function f_mill_count($from_date, $to_date){

        $sql = "SELECT `t`.`dist`, `m`.`district_name`, SUM(t.count) count FROM `md_district` `m`, (SELECT dist, `soc_id`, count(DISTINCT mill_id) count FROM td_received WHERE trans_dt BETWEEN '$from_date' AND '$to_date' GROUP BY dist, soc_id) t WHERE `m`.`district_code` = `t`.`dist`  GROUP BY `t`.`dist`";

        $result =   $this->db->query($sql);

        return $result->result();

    }
    public function f_mill_count_new($from_date, $to_date){

        // $sql = "SELECT `t`.`dist`, `m`.`district_name`, SUM(t.count) count
        //  FROM `md_district` `m`, (SELECT dist, `soc_id`, count(DISTINCT mill_id) count 
        // FROM td_received WHERE trans_dt BETWEEN '$from_date' AND '$to_date' GROUP BY dist, soc_id) t ,td_collections r
        //  WHERE `m`.`district_code` = `t`.`dist` 
        //  and r.dist=t.dist
        //  and r.soc_id=t.soc_id
        //  and  r.trans_dt BETWEEN '$from_date' AND '$to_date'
        //  and  GROUP BY `t`.`dist`";
$sql="SELECT t.dist, m.district_name, SUM(t.count) count
        FROM md_district m,    (SELECT dist, soc_id, count(DISTINCT mill_id) count 
        FROM td_received WHERE trans_dt BETWEEN '$from_date' AND '$to_date'
                                GROUP BY dist, soc_id) t ,   td_collections r
        WHERE m.district_code = t.dist
        and r.dist=t.dist
        and r.soc_id=t.soc_id
        and  r.trans_dt BETWEEN '$from_date' AND '$to_date'
        GROUP BY t.dist, m.district_name";
        $result =   $this->db->query($sql);

        return $result->result();

    }
    //paddy declaration report

    public function f_get_paddydeclr($from_date, $to_date){

        $data_array = array();

        $sql = "SELECT sl_no FROM  md_paddy_decl ";

        $result = $this->db->query($sql);

       $select = array("sl_no");
        
        if($result->row()){

            foreach($result->result() as $row){

                unset($sql);

                $sql = "SELECT sl_no, 
                               pur_dt, 
                               centre_name,
                               soc_name, 
                               paddy_qty, 
                               farmer_name, 
                               mill_name, 
                               rice_qty, 
                               balnc_qty	 
                                FROM `md_paddy_decl` ";
                
                $tempResult = $this->db->query($sql);      
                
                array_push($data_array, $tempResult->result());

            }

        }

        return $data_array;
        
    }


    //District Wise Report
    public function f_get_distwise($from_date, $to_date){

        $data_array = array();

        $sql = "SELECT DISTINCT soc_id, dist FROM  td_received
                                             WHERE trans_dt BETWEEN '$from_date' AND '$to_date'";

        $result = $this->db->query($sql);

       $select = array("soc_id", "dist");
        
        if($result->row()){

            foreach($result->result() as $row){

                unset($sql);

                $sql = "SELECT soc_id, 
                               mill_id, 
                               dist,
                               SUM(camp_no) camp_no, 
                               SUM(farmer_no) farmer_no, 
                               SUM(progressive) progressive, 
                               SUM(delivared_to_mill) delivared_to_mill, 
                               SUM(resultant_cmr) resultant_cmr, 
                               SUM(cmr_offered) cmr_offered, 
                               SUM(do_isseue) do_isseue, 
                               SUM(cmr_delivered) cmr_delivered FROM `td_transaction` 
                                                                WHERE soc_id = '$row->soc_id'
                                                                AND trans_dt BETWEEN '$from_date' AND '$to_date' GROUP BY soc_id, mill_id, dist";
                
                $tempResult = $this->db->query($sql);      
                
                array_push($data_array, $tempResult->result());

            }

        }

        return $data_array;
        
    }

    //Group of Districts
    public function f_get_dist_group_count($from_date, $to_date) {

        $sql = "SELECT a.dist, sum(mill) count FROM (SELECT dist, 
                                                            soc_id, 
                                                            mill_id, 
                                                            COUNT(DISTINCT mill_id) mill FROM `td_transaction` 
                                                                                     WHERE trans_dt BETWEEN '$from_date' AND '$to_date'
                                                                                     GROUP BY dist, soc_id, mill_id) a 
                                         GROUP BY a.dist";


        $result =   $this->db->query($sql);

        return $result->result();
        
    }
    

    //Block Wise Report

    public function f_get_blockwise($from_date, $to_date){

        $data_array = array();

        $sql = "SELECT DISTINCT soc_id, block FROM td_transaction
                                         WHERE trans_dt BETWEEN '$from_date' AND '$to_date'";

        $result = $this->db->query($sql);

       $select = array("soc_id", "block");
        
        if($result->row()){

            foreach($result->result() as $row){

                unset($sql);

                $sql = "SELECT soc_id, 
                               mill_id, 
                               block,
                               SUM(camp_no) camp_no, 
                               SUM(farmer_no) farmer_no, 
                               SUM(progressive) progressive, 
                               SUM(delivared_to_mill) delivared_to_mill, 
                               SUM(resultant_cmr) resultant_cmr, 
                               SUM(cmr_offered) cmr_offered, 
                               SUM(do_isseue) do_isseue, 
                               SUM(cmr_delivered) cmr_delivered FROM `td_transaction` 
                                                                WHERE soc_id = '$row->soc_id'
                                                                AND trans_dt BETWEEN '$from_date' AND '$to_date' GROUP BY soc_id, mill_id, block";
                
                $tempResult = $this->db->query($sql);      
                
                array_push($data_array, $tempResult->result());

            }

        }

        return $data_array;
        
    }

    public function f_get_block_group_count($from_date, $to_date) {

        $sql = "SELECT a.block, sum(mill) count FROM (SELECT block, 
                                                            soc_id, 
                                                            mill_id, 
                                                            COUNT(DISTINCT mill_id) mill FROM `td_transaction` 
                                                                                     WHERE trans_dt BETWEEN '$from_date' AND '$to_date'
                                                                                     GROUP BY block, soc_id, mill_id) a 
                                         GROUP BY a.block";


        $result =   $this->db->query($sql);

        return $result->result();
        
    }

    public function f_get_paddy_dtls($soc_id, $mill_id){

        $data_array['resultant'] =
        $data_array['offered'] =
        $data_array['isseued'] =
        $data_array['delivery'] = array();

        $where = array(

            'soc_id'    => $soc_id,

            'mill_id = "'.$mill_id.'" GROUP BY soc_id, mill_id' => NULL


        );

        $select = array(

            'soc_id', 'mill_id', 
            'ifnull(SUM(resultant_cmr), 0) resultant',
            'ifnull(SUM(tot_offered), 0) offered',
            'ifnull(SUM(sp), 0) offered_sp',
            'ifnull(SUM(cp), 0) offered_cp',
            'ifnull(SUM(fci), 0) offered_fci'

        );

        //CMR resultant and offer
        $result = $this->f_get_particulars('td_cmr_offered', $select, $where, 1);
        
        unset($select);

        $select = array(
            
            'soc_id', 'mill_id',
            'ifnull(SUM(tot_doisseued), 0) isseued',
            'ifnull(SUM(sp), 0) isseued_sp',
            'ifnull(SUM(cp), 0) isseued_cp',
            'ifnull(SUM(fci), 0) isseued_fci'
        
        );
        //CMR do isseued
        $result1 = $this->f_get_particulars('td_do_isseued', $select, $where, 1);

        unset($select);

        $select =   array(
            
            'soc_id', 'mill_id', 
            'ifnull(SUM(tot_delivery), 0) delivery',
            'ifnull(SUM(sp), 0) delivery_sp',
            'ifnull(SUM(cp), 0) delivery_cp',
            'ifnull(SUM(fci), 0) delivery_fci'
        );

        //CMR delivery
        $result2 = $this->f_get_particulars('td_cmr_delivery', $select, $where, 1);

        $data_array['resultant']    = (isset($result)? $result->resultant:0);
        $data_array['offered']      = (isset($result)? $result->offered:0);
        $data_array['offered_sp']   = (isset($result)? $result->offered_sp : 0);
        $data_array['offered_cp']   = (isset($result)? $result->offered_cp : 0);
        $data_array['offered_fci']  = (isset($result)? $result->offered_fci: 0);
        
        $data_array['isseued']      = (isset($result1)? $result1->isseued:0);
        $data_array['isseued_sp']   = (isset($result1)? $result1->isseued_sp : 0);
        $data_array['isseued_cp']   = (isset($result1)? $result1->isseued_cp : 0);
        $data_array['isseued_fci']  = (isset($result1)? $result1->isseued_fci: 0);
        
        $data_array['delivery']     = (isset($result2)? $result2->delivery:0);
        $data_array['delivery_sp']  = (isset($result2)? $result2->delivery_sp : 0);
        $data_array['delivery_cp']  = (isset($result2)? $result2->delivery_cp : 0);
        $data_array['delivery_fci'] = (isset($result2)? $result2->delivery_fci: 0);

        
        return $data_array;
    }

    //Payment Details
    public function f_get_payments(){

        $sql = "SELECT DISTINCT `t`.`pmt_bill_no`, `t`.`pool_type`,`md`.`district_name`, `ms`.`soc_name`, `mm`.`mill_name`, `t`.`trans_dt` 

                FROM `td_payment_bill` `t`, 
                
                (SELECT sl_no, soc_name FROM md_society) ms,
                (SELECT sl_no, mill_name FROM md_mill) mm,
                (SELECT district_code, district_name FROM md_district) md
                
                WHERE `t`.`dist` = `md`.`district_code` 
                AND `t`.`soc_id` = `ms`.`sl_no` 
                AND `t`.`mill_id` = `mm`.`sl_no`";

        $result = $this->db->query($sql);     
        
        return $result->result();
        
    }

    //Only One Payment
    public function f_get_payment($pmt_bill_no,$pool_type){
 

        $sql = "SELECT DISTINCT t.pmt_bill_no, t.dist, t.soc_id, t.mill_id, m.block, t.pool_type,
                                t.tot_paddy, t.tot_cmr, t.trans_dt, t.rice_type, t.extra_delivery
                FROM td_payment_bill t,md_society m
                WHERE t.pmt_bill_no = '$pmt_bill_no'
                And   t.pool_type   = '$pool_type'
                AND   t.soc_id      = m.sl_no";

        $result = $this->db->query($sql);     
       
        return $result->row();
        
    }

    //Commission Details
    public function f_get_commissions(){

        $sql = "SELECT DISTINCT `t`.`pmt_commission_no`, `md`.`district_name`, `ms`.`soc_name`, `t`.`trans_dt` 

                FROM `td_commission_bill` `t`, 
                
                (SELECT sl_no, soc_name FROM md_society) ms,
                (SELECT district_code, district_name FROM md_district) md
                
                WHERE `t`.`dist` = `md`.`district_code` 
                AND `t`.`soc_id` = `ms`.`sl_no`";

        $result = $this->db->query($sql);     
        
        return $result->result();
        
    }

    //Only One Commission
    public function f_get_commission($pmt_commission_no){

        $sql = "SELECT DISTINCT t.pmt_commission_no, t.dist, t.soc_id, m.block,
                                t.tot_paddy, t.trans_dt, t.pool_type, 
                                tc.tds_percentage, tc.deducted_amt,
                                tc.payble_amt
                FROM td_commission_bill t, 
                     md_society m,
                     td_commission_bill_dtls tc
                WHERE t.pmt_commission_no = tc.pmt_commission_no
                AND   t.pmt_commission_no = $pmt_commission_no
                AND   t.soc_id = m.sl_no";

        $result = $this->db->query($sql);     
        
        return $result->row();
        
    }

    //Payment Details
    public function f_payment($pmt_bill_no,$pool_type){

        $sql = "SELECT DISTINCT t.pmt_bill_no, t.kms_year, md.district_name, ms.soc_name, mm.mill_name, ms.block,
                                t.tot_paddy, t.tot_cmr, t.trans_dt, t.rice_type, t.extra_delivery
                FROM td_payment_bill t, 
                     md_society ms,
                     md_mill mm,
                     md_district md
                WHERE t.pmt_bill_no = (SELECT DISTINCT pmt_bill_no FROM td_payment_bill WHERE pmt_bill_no ='$pmt_bill_no')
                AND   t.soc_id      = ms.sl_no
                AND   t.mill_id     = mm.sl_no
                AND   t.dist        = md.district_code
                AND   t.pool_type   ='$pool_type'";

        $result = $this->db->query($sql);     
        
        return $result->row();
        
    }

    //Documents Maintenance
    public function f_doc_maintenance($bill_no, $poolType, $kms_year){

        $sql = "SELECT `m`.`sl_no`, `m`.`documents`, ifnull(`t`.`status`, 0) status
                FROM `md_documents` `m` LEFT JOIN (SELECT `doc_id`, `status` FROM `td_doc_maintenance` 
                WHERE `bill_no` = '$bill_no' AND `pool_type` = '$poolType' AND `kms_year` = '$kms_year') t ON `m`.`sl_no` = `t`.`doc_id` ORDER BY `m`.`sl_no`";

        $result = $this->db->query($sql);

        return $result->result();

    }

    //Paid Details
    public function f_get_paids($paid_id){

        $sql = "SELECT t.payment_dt, t.paid_no, t.total_payble, t.amount,
                       t.trans_type, t.chq_no, t.chq_dt, t.bank, t.pool_type
                
                FROM td_paid_dtls t
                                        
                WHERE t.paid_no = $paid_id";

        $result = $this->db->query($sql);

        return $result->row();
        
    }

    //Get Mill Details Which are included in particular society
    public function getMillDtls($socId, $dist){
        $sql = "SELECT m.sl_no, m.mill_name, ifnull(t.mill_id, 0) checkId
                FROM md_mill m LEFT JOIN md_soc_mill t
                ON m.dist = t.dist
                AND m.sl_no = t.mill_id
                AND t.soc_id = $socId
                WHERE
                m.dist = $dist";

        return $this->db->query($sql)->result();        
    }

    //Checking a particular Bill No for a particular pool type is present or not
    public function f_check_bill_no($billArray, $poolType, $kms){

        $this->db->distinct();
        $this->db->select('bill_no');
        $this->db->where('kms_yr', $kms);
        $this->db->where('pool_type', $poolType);
        $this->db->where_in('bill_no', explode(',', $billArray));
        $result = $this->db->get('td_bill');

        return $result->result();
    }

    //Payble Bill No(s)
    public function f_payble_bill_no($billArray, $poolType, $kms){

        $sql = "SELECT DISTINCT tb.`con_bill_no` as `bill_no` 
                FROM `td_payment_bill` tb, td_bill t
                WHERE tb.con_bill_no = t.bill_no
                AND tb.`kms_year` = '$kms' 
                AND t.`pool_type` = '$poolType' 
                AND tb.`con_bill_no` IN ($billArray)";

        $result = $this->db->query($sql);

        return $result->result();
    }

    //All Billing amount
    public function f_allBillAmount($bills, $poolType, $kms){
        
        $billsArray = explode(',', $bills);
        $sum = 0.00;

        for($i = 0; $i < count($billsArray); $i++){

            $sql = "SELECT (tot_msp
                            +
                            market_fee
                            +
                            mandi_chrg
                            +
                            transportation1
                            +
                            transportation2
                            +
                            transportation3
                            +
                            driage
                            +
                            comm_soc
                            +
                            comm_mill
                            +
                            cgst_milling
                            +
                            sgst_milling
                            +
                            admin_chrg
                            +
                            transportation_cmr1
                            +
                            gunny_usege
                            +
                            cgst_gunny
                            +
                            sgst_gunny
                            -
                            butta_cut
                            -
                            gunny_cut) tot FROM td_bill
                WHERE kms_yr = '$kms'
                AND pool_type = '$poolType'
                AND bill_no = $billsArray[$i]";

            $data = $this->db->query($sql);

            if($data->num_rows() > 0)
                $sum += $data->row()->tot;

            unset($data);

        }

        return $sum;
    }

    //Check Bill No present in the table  bill_no
    public function f_exsists($table_name, $billArray, $poolType, $kms){
        $this->db->select('bill_no');
        $this->db->where('kms_year', $kms);
        $this->db->where('pool_type', $poolType);
        $this->db->where_in('bill_no', explode(',', $billArray));
        return $this->db->get($table_name)->result();
        
    }

    //Total Receivable for a particular pool type
    public function f_getReceivable($billNos,$kms){
        $sql = "SELECT tr.received_no, tr.receivable_amt
                FROM `td_received_bill_dtls` tb, `td_payment_received` tr
                WHERE tb.received_no = tr.received_no
                AND tb.kms_year = '$kms'
                AND tb.pool_type = '".$this->input->get('pool_type')."'
                AND tb.bill_no IN ($billNos)
                GROUP BY tr.received_no
                ORDER BY tr.received_no DESC LIMIT 0,1";

        $data = $this->db->query($sql);
        
        if($data->num_rows() > 0){
            return $data->row();
        }
        else{
            return false;
        }
            
    }
    public function js_get_bill($dist)
    {

        $sql = $this->db->query("SELECT bill_no FROM td_bill WHERE dist = '$dist'  Order by bill_no	 ");
        // print_r($sql);
        // die();
        return $sql->result();

    }
    
    //All Procurement between two dates
    public function f_get_procurements(){

        $sql = "SELECT t1.*, t2.farmer_no FROM 
                (SELECT `d`.`district_name`,
                `m`.`soc_name`, t.soc_id, SUM(t.no_of_camp) no_of_camp, 
                SUM(t.no_of_farmer) no_of_farmer, 
                SUM(t.paddy_qty) paddy_qty 
                FROM `td_collections` `t`, `md_district` `d`, `md_society` `m`
                WHERE `t`.`dist` = `d`.`district_code` 
                AND `t`.`soc_id` = `m`.`sl_no`
                AND t.trans_dt 
                BETWEEN '".$this->input->post('from_date')."' 
                AND '".$this->input->post('to_date')."' GROUP BY `d`.`district_name`, `m`.`soc_name`) t1,
                (SELECT soc_id, SUM(farmer_no) farmer_no FROM
                td_reg_farmer 
                WHERE trans_dt 
                BETWEEN '".$this->input->post('from_date')."' 
                AND '".$this->input->post('to_date')."' 
                GROUP BY soc_id) t2 
                WHERE t1.soc_id = t2.soc_id ORDER BY t1.district_name";
    
        return $this->db->query($sql)->result();
    }
    public function insert_wqsc($dis_cd,$bill_no,$pool_type,$wqsc_no,$analysis_no,$trn_dt,$no_bags,$qty,$remarks,$kms_year,$Unit_count)
	{
    //    echo $kms_year;
    //    die();
		for($j=0; $j<$Unit_count ; $j++)
		{
            $value1 = array('dis_cd'        => $dis_cd,
                            'bill_no'       => $bill_no,
                            'pool_type'     => $pool_type,
                            'wqsc_no'       => $wqsc_no[$j],
                            'analysis_no'   => $analysis_no[$j],
                            'trn_dt'        => $trn_dt[$j],
                            'no_bags'       => $no_bags[$j],
                            'qty'           => $qty[$j],
                            'remarks'       => $remarks[$j],
						    'kms_yr'        => $kms_year);
			$this->db->insert('td_wqsc_sheet',$value1);
			// $sql = "update td_wqsc_sheet set qty=qty - $qty[$j]  WHERE Batch='$Batch[$j]'";
			// $this->db->query($sql);
		//  echo $this->db->last_query();
		// 	die();
		}
		
	}
    public function updatewqsc($dis_cd,$bill_no,$pool_type,$wqsc_no,$analysis_no,$trn_dt,$no_bags,$qty,$remarks,$Unit_count )
    {

        // print_r( $wqsc_no )  ;
        // die();
        //    echo $Unit_count;
        //   die();
        for($j=0; $j<$Unit_count ; $j++)
		{
        $value = array( 'dis_cd'         => $dis_cd,
                        'bill_no'       => $bill_no,
                        'pool_type'     => $pool_type,
                        'wqsc_no'       => $wqsc_no[$j],
                        'analysis_no'   => $analysis_no[$j],
                        'trn_dt'        => $trn_dt[$j],
                        'no_bags'       => $no_bags[$j],
                        'qty'           => $qty[$j],
                        'remarks'       => $remarks[$j]);
                        // echo $this->db->last_query($);
                        // print_r($wqsc_no[$j]) ;
                        //  die();
        $this->db->where('bill_no', $bill_no);
        $this->db->where('pool_type', $pool_type);
        $this->db->where('dis_cd', $dis_cd);
        $this->db->where('wqsc_no' , $wqsc_no[$j]) ;
        
        // $this->db->where('wqsc_no', $wqsc_no);
        // $this->db->where('wqsc_no', $wqsc_no[$j]);
        // $this->Paddy->f_delete('td_wqsc_sheet', $where);
        $this->db->update('td_wqsc_sheet', $value);
        //  echo $this->db->last_query();
        //   die();
       
    }
   
}
function doAlert() {
    doAlert();
 }
}