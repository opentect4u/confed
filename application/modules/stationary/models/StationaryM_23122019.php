<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

    class StationaryM extends CI_Model
    {

    // ************************ For Unit Master *************************** //

        public function f_get_unit_table()
        {

            $sql = $this->db->query(" SELECT * FROM md_stn_unit ");
            return $sql->result();

        }

        public function f_get_unitSlNo_max()
        {

            $sql = $this->db->query(" SELECT MAX(sl_no) AS sl_no FROM md_stn_unit ");
            return $sql->row();

        }

        public function addNewUnit($sl_no, $unit, $created_by, $created_dt)
        {

            $value = array('sl_no' => $sl_no,
                        'unit' => $unit,
                        'created_by' => $created_by,
                        'created_dt' => $created_dt );
            
            $this->db->insert('md_stn_unit',$value);

        }

        public function f_get_unit_editData($sl_no)
        {

            $sql = $this->db->query(" SELECT * FROM md_stn_unit WHERE sl_no = $sl_no ");
            return $sql->result();

        }


        public function updateUnit($sl_no, $unit, $modified_by, $modified_dt)
        {

            $value = array( 'unit' => $unit,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt );
                        
            $this->db->where('sl_no',$sl_no);
            $this->db->update('md_stn_unit',$value);

        }

        public function deleteUnit($sl_no)
        {
            $sql = $this->db->query(" DELETE FROM md_stn_unit WHERE sl_no = $sl_no ");
        }



    // ************************** For Supplier Master ********************** //

        public function f_get_supplier_table()
        {

            $sql = $this->db->query(" SELECT * FROM md_stn_supplier ");
            return $sql->result();

        }

        public function js_edit_supplier_renewalStatus($sl_no, $cur_status) // For JS
        {

            if($cur_status == 0)
            {
                $sql = $this->db->query(" UPDATE md_stn_supplier SET renewal = 1 WHERE sl_no = $sl_no ");
            }
            elseif($cur_status ==1)
            {
                $sql = $this->db->query(" UPDATE md_stn_supplier SET renewal = 0 WHERE sl_no = $sl_no ");
            }

        }

        public function js_get_supplier_cur_RenewalStatus($sl_no)
        {

            $sql = $this->db->query(" SELECT renewal FROM md_stn_supplier WHERE sl_no = $sl_no ");
            return $sql->row();

        }

        public function f_get_supplierSlNo_max()
        {

            $sql = $this->db->query(" SELECT MAX(sl_no) AS sl_no FROM md_stn_supplier "); 
            return $sql->row();

        }
        
        public function addNewSupplier($sl_no, $name, $contact_person, $phn_no, $email, $address, $gst_no, $pan_no, $trd_license, $bank, $accnt_no, $ifsc, $st, $it, $created_by, $created_dt)
        {

            $value = array('sl_no' => $sl_no,
                        'name' => $name,
                        'contact_person' => $contact_person,
                        'phn_no' => $phn_no,
                        'email' => $email,
                        'address' => $address,
                        'gst_no' => $gst_no,
                        'pan_no' => $pan_no,
                        'trd_license' => $trd_license,
                        'bank' => $bank,
                        'accnt_no' => $accnt_no,
                        'ifsc' => $ifsc,
                        'st' => $st,
                        'it' => $it,
                        'created_by' => $created_by,
                        'created_dt' => $created_dt );
            
            $this->db->insert('md_stn_supplier',$value);                        

        }

        public function f_get_supplierEditData($sl_no)
        {

            $sql = $this->db->query(" SELECT * FROM md_stn_supplier WHERE sl_no = $sl_no ");
            return $sql->result();

        }

        public function updateNewSupplier($sl_no, $name, $contact_person, $phn_no, $email, $address, $gst_no, $pan_no, $trd_license, $bank, $accnt_no, $ifsc, $st, $it, $modified_by, $modified_dt)
        {

            $value = array(
                        'name' => $name,
                        'contact_person' => $contact_person,
                        'phn_no' => $phn_no,
                        'email' => $email,
                        'address' => $address,
                        'gst_no' => $gst_no,
                        'pan_no' => $pan_no,
                        'trd_license' => $trd_license,
                        'bank' => $bank,
                        'accnt_no' => $accnt_no,
                        'ifsc' => $ifsc,
                        'st' => $st,
                        'it' => $it,
                        'modified_by' => $modified_by,
                        'modified_dt' => $modified_dt );
            
            $this->db->where('sl_no',$sl_no);
            $this->db->update('md_stn_supplier',$value);

        }

        public function deleteSupplier($sl_no)
        {
            $sql = $this->db->query(" DELETE FROM md_stn_supplier WHERE sl_no = $sl_no ");
        }



        // ******************** For Project Master ******************* // 

        public function f_get_projects_table()
        {

            $sql = $this->db->query("  SELECT a.project_cd, a.name, a.phn_no, GROUP_CONCAT(c.name) AS supplier 
                                    FROM md_stn_project a, md_stn_project_dtls b, md_stn_supplier c 
                                    WHERE a.project_cd = b.project_cd
                                    AND b.supplier_cd = c.sl_no
                                    GROUP BY a.project_cd, a.name, a.phn_no
                                    ORDER BY a.project_cd ");
                                    
            return $sql->result();

        }

        public function f_get_suppliersData()
        {

            $sql = $this->db->query(" SELECT sl_no, name FROM md_stn_supplier ");
            return $sql->result();

        }

        public function f_get_projectCd_max()
        {

            $sql = $this->db->query(" SELECT MAX(project_cd) AS project_cd FROM md_stn_project ");
            return $sql->row();

        }

        public function addNewProject($project_cd, $name, $phn_no, $address, $supplier_cd, $supplier_no, $created_by, $created_dt)
        {

            $value = array('project_cd' => $project_cd,
                        'name' => $name,
                        'phn_no' => $phn_no,
                        'address' => $address,
                        'created_by' => $created_by,
                        'created_dt' => $created_dt );
            
            $this->db->insert('md_stn_project',$value); 

        }

        public function addNewProjectDtls($project_cd, $name, $phn_no, $address, $supplier_cd, $supplier_no, $created_by, $created_dt)
        {

            for($i=0; $i<$supplier_no; $i++)
            {
                $value = array('project_cd' => $project_cd,
                        'supplier_cd' => $supplier_cd[$i],
                        'created_by' => $created_by,
                        'created_dt' => $created_dt );
            
                $this->db->insert('md_stn_project_dtls',$value); 
            }

        }

        public function f_get_projectEditData($project_cd)
        {

            $sql = $this->db->query(" SELECT * FROM md_stn_project WHERE project_cd = '$project_cd' ");
            return $sql->result();

        }

        public function f_get_projectDetailsEditData($project_cd)
        {

            $sql = $this->db->query(" SELECT a.supplier_cd, b.name FROM md_stn_project_dtls a, md_stn_supplier b 
                                    WHERE a.supplier_cd = b.sl_no AND a.project_cd = '$project_cd' ");
            return $sql->result();

        }

        public function updateNewProject($project_cd, $name, $phn_no, $address, $supplier_cd, $supplier_no, $modified_by, $modified_dt)
        {

            $value = array( 'name' => $name,
                            'phn_no' => $phn_no,
                            'address' => $address,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt );
                            
            $this->db->where('project_cd',$project_cd);
            $this->db->update('md_stn_project',$value);

        }

        public function deleteProject($project_cd)
        {
            $sql = $this->db->query(" DELETE FROM md_stn_project WHERE project_cd = $project_cd ");
        }

        public function deleteProjectDtls($project_cd)
        {
            $sql = $this->db->query(" DELETE FROM md_stn_project_dtls WHERE project_cd = $project_cd ");
        }


    // *********************** For Transaction/ Order Section ************************ //


        public function f_get_order_table()
        {

            $sql = $this->db->query("SELECT a.project_cd, a.c_order_no, a.c_order_dt, b.name AS supplier, c.name AS project   
                                    FROM td_stn_order a, md_stn_supplier b, md_stn_project c
                                    WHERE a.supplier_cd = b.sl_no 
                                    AND a.project_cd = c.project_cd 
                                    GROUP BY a.c_order_no, a.c_order_dt, b.name, c.name, a.project_cd ");
            return $sql->result();

        }

        public function f_get_supplierData()
        {

            $sql = $this->db->query(" SELECT sl_no, name FROM md_stn_supplier  ");
            return $sql->result();

        }

        public function f_get_projectData()
        {

            $sql = $this->db->query(" SELECT * FROM md_stn_project order by name");
            return $sql->result();

        }

        public function js_get_C_OrderNo_validation($c_order_no)
        {

            $sql = $this->db->query(" SELECT COUNT( * ) AS num_row FROM `td_stn_order` WHERE c_order_no = '$c_order_no' ");
            return $sql->row();

        }

        public function js_get_suppliersForProject($project_cd)
        {

            $sql = $this->db->query(" SELECT a.supplier_cd, b.name FROM md_stn_project_dtls a, md_stn_supplier b
                                    WHERE a.supplier_cd = b.sl_no 
                                    AND a.project_cd = $project_cd
                                    order by b.name");
            return $sql->result();

        }

        public function js_get_supplier_status($supplier_cd,$order_dt)
        {
            $sql    =   $this->db->query("select status from td_stm_renewal
                                          where  supp_no        = $supplier_cd
                                          and    effective_dt   = (select max(effective_dt)
                                                                   from   td_stm_renewal
                                                                   where  supp_no        = $supplier_cd)                                   
                                          and    sl_no          =  (select max(sl_no)
                                                                    from   td_stm_renewal
                                                                    where  effective_dt <='$order_dt'
                                                                    and    supp_no = $supplier_cd)
                                          ");   
            return $sql->row(); 
        }


        public function addNewOrder($c_order_dt, $c_order_no, $supplier_cd, $g_order_dt, $g_order_no, $project_cd, $remarks, $row, $created_by, $created_dt)
        {

            for($i= 0; $i<$row; $i++)
            {
                $value = array('g_order_dt' => $g_order_dt[$i],
                        'g_order_no' => $g_order_no[$i],
                        'g_sl_no' => $i, 
                        'c_order_dt' => $c_order_dt,
                        'c_order_no' => $c_order_no,
                        'project_cd' => $project_cd[$i],
                        'supplier_cd' => $supplier_cd,
                        // 'tot_amount' => $tot_amount,
                        'remarks' => $remarks,
                        'created_by' => $created_by,
                        'created_dt' => $created_dt );
            
                $this->db->insert('td_stn_order',$value);

            }

        }

        // public function addNewOrderDtls($order_no, $item_name, $unit, $qty, $rate, $item_no, $created_by, $created_dt)
        // {

        //     for($i=0; $i<$item_no; $i++)
        //     {

        //         $value = array(
        //                 'order_no' => $order_no,
        //                 'item_name' => $item_name[$i],
        //                 'unit' => $unit[$i],
        //                 'qty' => $qty[$i],
        //                 'rate' => $rate[$i],
        //                 'created_by' => $created_by,
        //                 'created_dt' => $created_dt );
            
        //         $this->db->insert('td_stn_order_dtls',$value);

        //     }

        // }

        public function deleteOrder($c_order_no, $c_order_dt, $project_cd)
        {
            $sql = $this->db->query(" DELETE FROM td_stn_order WHERE c_order_no = '$c_order_no' AND c_order_dt = '$c_order_dt' AND project_cd = '$project_cd' ");
        }

        // public function deleteOrderDtls($order_no)
        // {
        //     $sql = $this->db->query(" DELETE FROM td_stn_order_dtls WHERE order_no = '$order_no' ");
        // }

        public function f_get_orderEditData($c_order_no, $c_order_dt)
        {

            $sql = $this->db->query(" SELECT DISTINCT c_order_dt, c_order_no, supplier_cd, tot_amount, remarks
                                    FROM td_stn_order 
                                    WHERE c_order_no = '$c_order_no'
                                    AND c_order_dt = '$c_order_dt'
                                    ORDER BY sl_no ");
                                     
            return $sql->result();

        }

        public function f_get_orderEditDataDtls($c_order_no, $c_order_dt)
        {

            $sql = $this->db->query(" SELECT a.g_order_no, a.g_order_dt, a.project_cd, b.name 
                                    FROM td_stn_order a, md_stn_project b 
                                    WHERE a.project_cd = b.project_cd
                                    AND a.c_order_no = '$c_order_no' 
                                    AND a.c_order_dt = '$c_order_dt'
                                    ORDER BY a.sl_no  ");

            return $sql->result();

        }

        public function updateOrder($c_order_dt, $c_order_no, $g_order_dt, $g_order_no, $project_cd, $supplier_cd, $remarks, $row, $modified_by, $modified_dt)
        {
            $sql = $this->db->query(" DELETE FROM td_stn_order WHERE c_order_no = '$c_order_no' AND c_order_dt = '$c_order_dt' ");
            
            for($i= 0; $i< $row; $i++)
            {
                $value = array( 'g_order_dt' => $g_order_dt[$i],
                                'g_order_no' => $g_order_no[$i],
                                'c_order_dt' => $c_order_dt,
                                'c_order_no' => $c_order_no,
                                'project_cd' => $project_cd[$i],
                                'supplier_cd' => $supplier_cd,
                                //'tot_amount' => $tot_amount,
                                'remarks' => $remarks,
                                'modified_by' => $modified_by,
                                'modified_dt' => $modified_dt );
                            
                //$this->db->where('order_dt',$order_dt);
                //$this->db->where('c_order_no',$c_order_no);
                $this->db->insert('td_stn_order',$value);
            }

        }

        // public function updateOrderDtls($order_no, $item_name, $unit, $qty, $rate, $item_no, $modified_by, $modified_dt)
        // {

        //     for($i=0; $i<$item_no; $i++)
        //     {
        //         $value = array( 'item_name' => $item_name[$i],
        //                         'unit' => $unit[$i],
        //                         'qty' => $qty[$i],
        //                         'rate' => $rate[$i],
        //                         'modified_by' => $modified_by,
        //                         'modified_dt' => $modified_dt );
                            
        //         $this->db->where('order_no','$order_no');
        //         $this->db->update('td_stn_order_dtls',$value);
        //     }

        // }

    // **************************** For Bill/ Purchase Bill ********************** //

    
        public function f_get_pBill_table()
        {

            $sql = $this->db->query(" SELECT distinct a.bill_no,a.bill_dt,a.order_no,c.name ,a.total FROM td_stn_purchaseBill a, td_stn_order b ,md_stn_supplier c where  a.order_no=b.c_order_no and b.supplier_cd=c.sl_no ");
            return $sql->result();

        }

        public function js_get_supplierAsPerOrder($order_no)
        {

            $sql = $this->db->query(" SELECT b.name FROM td_stn_order a, md_stn_supplier b 
                                    WHERE a.supplier_cd = b.sl_no AND a.c_order_no = '$order_no' ");
            return $sql->row();

        }

        public function js_get_check_duplicate_billEntry_forDate($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS num_row FROM td_stn_purchaseBill WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");
            return $sql->row();

        }

        public function js_get_check_PBillNo_forDate($pb_no, $order_no)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS num_row FROM td_stn_purchaseBill WHERE bill_no = '$pb_no' AND order_no = '$order_no' ");
            return $sql->row();

        }

        public function js_get_order_validationFor_purchaseBill($order_no)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS num_row FROM td_stn_order WHERE c_order_no = '$order_no' ");
            return $sql->row();

        }

        public function js_get_order_validationFor_saleBill($order_no)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS num_row FROM td_stn_order WHERE c_order_no = '$order_no' ");
            return $sql->row();

        }


        public function f_get_slNo_from_purchaseBillDtls($bill_dt, $bill_no)
        {

            $sql = $this->db->query(" SELECT MAX(sl_no) AS sl_no FROM td_stn_pbill_dtls WHERE bill_dt = '$bill_dt' AND bill_no = '$bill_no' ");
            return $sql->row();

        }

        public function addNewPBill($bill_dt, $bill_no, $order_no, $nt, $non_tax, $total, $created_by, $created_dt )
        {

            $value = array( 'bill_dt' => $bill_dt,
                            'bill_no' => $bill_no,
                            'order_no' => $order_no,
                            'nt' => $nt,
                            'non_tax' => $non_tax,
                            'total' => $total,
                            'created_by' => $created_by,
                            'created_dt' => $created_dt );
                
    
            $this->db->insert('td_stn_purchaseBill', $value);

        }

        public function addNewPBillDtls($sl_no, $bill_dt, $bill_no, $gst_per, $sub_amnt, $cgst_val, $sgst_val, $created_by, $created_dt, $row )
        {

            for($i=0; $i<$row; $i++)
            {

                $value = array('sl_no' => $sl_no+$i,
                                'bill_dt' => $bill_dt,
                                'bill_no' => $bill_no,
                                'gst_per' => $gst_per[$i],
                                'sub_amnt' => $sub_amnt[$i],
                                'cgst_val' => $cgst_val[$i],
                                'sgst_val' => $sgst_val[$i],
                                'created_by' => $created_by,
                                'created_dt' => $created_dt );

                $this->db->insert('td_stn_pbill_dtls', $value);

            }

        }

        public function f_get_edit_pBillData($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" SELECT bill_dt, bill_no, order_no, nt, non_tax, total
                                    FROM td_stn_purchaseBill WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");
                                    
            return $sql->result();

        }

        public function f_get_pBillEdit_orderNo($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" SELECT order_no FROM td_stn_purchaseBill WHERE
                                    bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");
            return $sql->row();

        }

        public function f_get_edit_pBillDtlsData($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" SELECT sl_no, gst_per, sub_amnt, cgst_val, sgst_val FROM td_stn_pbill_dtls WHERE bill_dt = '$bill_dt' AND bill_no = '$bill_no' ");
            return $sql->result();

        }

        public function updatePBill($bill_dt, $bill_no, $order_no, $nt, $non_tax, $total, $modified_by, $modified_dt )
        {
            
            $value = array( 'bill_dt' => $bill_dt,
                            'order_no' => $order_no,
                            'nt' => $nt,
                            'non_tax' => $non_tax,
                            'total' => $total,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt );
                
            $this->db->where('bill_no', $bill_no);
            $this->db->where('bill_dt', $bill_dt);
            $this->db->update('td_stn_purchaseBill', $value);

        }


        public function deletePBill($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" DELETE FROM td_stn_purchaseBill WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");

        }

        public function deletePBillDtls($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" DELETE FROM td_stn_pbill_dtls WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");

        }


        // FOR Bill / Sale Bill -----

        public function f_get_sBill_table()
        {

            $sql = $this->db->query(" SELECT bill_dt, bill_no, order_no, total FROM td_stn_saleBill ");
            return $sql->result();

        }


        public function js_get_check_duplicate_saleBillEntry_forDate($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS num_row FROM td_stn_saleBill WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");
            return $sql->row();

        }


        public function f_get_slNo_from_sBillDtls($bill_dt, $bill_no)
        {

            $sql = $this->db->query(" SELECT ifnull(MAX(sl_no),0)slno FROM td_stn_sBillDtls WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");
            return $sql->row();

        }

        public function addNewSBill($bill_dt, $bill_no, $order_no, $pb_no, $nt, $non_tax, $total, $created_by, $created_dt )
        {

            $value = array('bill_dt' => $bill_dt,
                            'bill_no' => $bill_no,
                            'order_no' => $order_no,
                            'pb_no' => $pb_no,
                            'nt' => $nt,
                            'non_tax' => $non_tax,
                            'total' => $total,
                            'created_by' => $created_by,
                            'created_dt' => $created_dt );

            $this->db->insert('td_stn_saleBill', $value);              

        }

        public function addNewSBillDtls($sl_no, $bill_dt, $bill_no, $gst_per, $sub_amnt, $cgst_val, $sgst_val, $created_by, $created_dt, $row )
        {

            for($i=0; $i<$row; $i++)
            {
                $value = array('sl_no' => $sl_no+$i,
                                'bill_dt' => $bill_dt,
                                'bill_no' => $bill_no,
                                'gst_per' => $gst_per[$i],
                                'sub_amnt' => $sub_amnt[$i],
                                'cgst_val' => $cgst_val[$i],
                                'sgst_val' => $sgst_val[$i],
                                'created_by' => $created_by,
                                'created_dt' => $created_dt );

                $this->db->insert('td_stn_sBillDtls', $value);

            }

        }

        public function f_get_edit_sBillData($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" SELECT bill_dt, bill_no,pb_no, order_no, nt, non_tax, total
                                    FROM td_stn_saleBill WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt'  ");
            return $sql->result();

        }

        public function f_get_edit_sBillDtlsData($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" SELECT gst_per, sub_amnt, cgst_val, sgst_val FROM td_stn_sBillDtls WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");
            return $sql->result();

        }

        public function f_get_edit_sBillOrderNo($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" SELECT order_no FROM td_stn_saleBill WHERE
                                    bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");
            return $sql->row();

        }

       
        public function updateSBill($bill_dt, $bill_no, $order_no, $nt, $non_tax, $total, $modified_by, $modified_dt )
        {
                           
            $value = array('order_no'   => $order_no,
                           'nt'         => $nt,
                           'non_tax'    => $non_tax, 
                           'total'      => $total,
                           'modified_by' => $modified_by,
                           'modified_dt' => $modified_dt);

            $this->db->where('bill_no', $bill_no);
            $this->db->where('bill_dt', $bill_dt);
            $this->db->update('td_stn_saleBill', $value);   

        }

        public function updateSBillDtls($sl_no, $bill_dt, $bill_no, $gst_per, $sub_amnt, $cgst_val, $sgst_val, $created_by, $created_dt, $row )
        {

            for($i=0; $i<$row; $i++)
            {
                $value = array('sl_no'       => $sl_no+$i,
                                'bill_no'    => $bill_no,
                                'bill_dt'    => $bill_dt,
                                'gst_per'    => $gst_per[$i],
                                'sub_amnt'   => $sub_amnt[$i],
                                'cgst_val'   => $cgst_val[$i],
                                'sgst_val'   => $sgst_val[$i],
                                'created_by' => $created_by,
                                'created_dt' => $created_dt );

                $this->db->insert('td_stn_sBillDtls', $value);

            }

        }

        public function deletesBill($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" DELETE FROM td_stn_saleBill WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");

        }

        public function deleteSBillDtls($bill_no, $bill_dt)
        {

            $sql = $this->db->query(" DELETE FROM td_stn_sBillDtls WHERE bill_no = '$bill_no' AND bill_dt = '$bill_dt' ");

        }


        // ********************* For Order Report ***************** //

        public function f_get_orderReportData($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT DISTINCT a.c_order_dt, a.c_order_no, GROUP_CONCAT(CONCAT(a.g_order_no) ORDER BY a.c_order_no ) AS g_order_no, a.tot_amount, b.name AS project, c.name AS supplier 
                                    FROM td_stn_order a, md_stn_project b, md_stn_supplier c 
                                    WHERE a.project_cd = b.project_cd AND a.supplier_cd = c.sl_no
                                    AND a.c_order_dt >= '$startDt' AND a.c_order_dt <= '$endDt'
                                    GROUP BY a.c_order_no, a.c_order_dt, a.tot_amount, b.name, c.name ");
            return $sql->result();

        }

        // public function f_get_orderReportAmount($startDt, $endDt)
        // {

        //     $sql = $this->db->query(" SELECT SUM(tot_amount) AS amount FROM td_stn_order 
        //                             WHERE c_order_dt >= '$startDt' AND c_order_dt <= '$endDt' ");
        //     return $sql->row();

        // }

        public function f_get_billReportData($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT DISTINCT a.order_no, a.bill_no AS pb, a.bill_dt AS pB_dt, a.total AS p_total, SUM(b.cgst_val) AS tot_p_cgst, SUM(b.sgst_val) AS tot_p_sgst, c.bill_no AS sb, c.total AS s_total, SUM(d.cgst_val) AS tot_s_cgst, SUM(d.sgst_val) AS tot_s_sgst 
                                    FROM td_stn_purchaseBill a, td_stn_pbill_dtls b, td_stn_saleBill c, td_stn_sBillDtls d 
                                    WHERE a.order_no = c.order_no
                                    AND a.bill_no = c.pb_no
                                    AND a.bill_no = b.bill_no
                                    AND a.bill_dt = b.bill_dt
                                    AND c.bill_no = d.bill_no
                                    AND d.bill_dt = d.bill_dt 
                                    AND a.bill_dt >= '$startDt'
                                    AND a.bill_dt <= '$endDt'
                                    GROUP BY a.bill_no, a.bill_dt, a.order_no, a.total, c.bill_no, c.total ");

            return $sql->result();

        }

        public function f_get_billReport_orderNo_count($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS count FROM 
                                    (SELECT DISTINCT a.order_no, a.bill_no AS pb, a.bill_dt AS pB_dt, a.total AS p_total, SUM(b.cgst_val) AS tot_p_cgst, SUM(b.sgst_val) AS tot_p_sgst, c.bill_no AS sb, c.total AS s_total, SUM(d.cgst_val) AS tot_s_cgst, SUM(d.sgst_val) AS tot_s_sgst                                     
                                    FROM td_stn_purchaseBill a, td_stn_pbill_dtls b, td_stn_saleBill c, td_stn_sBillDtls d  
                                    WHERE a.order_no = c.order_no
                                    AND a.bill_no = c.pb_no
                                    AND a.bill_no = b.bill_no
                                    AND a.bill_dt = b.bill_dt
                                    AND c.bill_no = d.bill_no
                                    AND d.bill_dt = d.bill_dt 
                                    AND a.bill_dt >= '$startDt'
                                    AND a.bill_dt <= '$endDt'
                                    GROUP BY a.bill_no, a.bill_dt, a.order_no, a.total, c.bill_no, c.total ) X 
                                    WHERE 1 GROUP BY order_no  ");

            return $sql->row();

        }


        public function f_get_billReport_totPBill_amount($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(total) AS pb_tot FROM td_stn_purchaseBill 
                                    WHERE bill_dt >= '$startDt'
                                    AND bill_dt <= '$endDt' ");
                                     
            return $sql->row();

        }

        public function f_get_billReport_totSBill_amount($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(total) AS sb_tot FROM td_stn_saleBill
                                    WHERE bill_dt >= '$startDt'
                                    AND bill_dt <= '$endDt' ");
                                     

            return $sql->row();

        }

    // ***************** For Transaction / Collection ******************* //

        public function f_get_billCollectionData()
        {

            $sql = $this->db->query(" SELECT * FROM td_stn_collection ");
            return $sql->result();

        }

        
        public function addNewCollection($trans_dt, $order_no, $bill_no, $mode, $ref_no, $amount, $remarks, $created_by, $created_dt )
        {

            $value = array('trans_dt' => $trans_dt,
                            'order_no' => $order_no,
                            'bill_no' => $bill_no,
                            'mode' => $mode,
                            'ref_no' => $ref_no,
                            'amount' => $amount,
                            'remarks' => $remarks,
                            'created_by' =>$created_by,
                            'created_dt' => $created_dt );

            $this->db->insert('td_stn_collection', $value);              
            
        }

        public function js_get_collection_orderForProject($project_cd) // For JS
        {

            $sql = $this->db->query(" SELECT DISTINCT b.order_no FROM td_stn_order a, td_stn_saleBill b WHERE a.c_order_no = b.order_no
                                        AND a.project_cd = $project_cd ");
            return $sql->result();

        }

        public function js_get_collection_billForOrder($order_no) // For JS
        {

            $sql = $this->db->query(" SELECT bill_no FROM td_stn_saleBill WHERE order_no = '$order_no' ");
            return $sql->result();

        }

        public function js_get_collection_amountForBill($bill_no) // For JS
        {

            $sql = $this->db->query(" SELECT tot_amount FROM td_stn_saleBill WHERE bill_no = '$bill_no' ");
            return $sql->row();

        }

        public function f_get_billCollection_editData($sl_no, $bill_no)
        {

            $sql = $this->db->query(" SELECT * FROM td_stn_collection WHERE sl_no = $sl_no AND bill_no = '$bill_no' ");
            return $sql->result();

        }


        public function f_get_billCollectionEdit_project($sl_no, $bill_no)
        {

            $sql = $this->db->query(" SELECT c.name AS project FROM td_stn_collection a, td_stn_order b, md_stn_project c
                                    WHERE a.order_no = b.c_order_no
                                    AND b.project_cd = c.project_cd
                                    AND a.sl_no = $sl_no
                                    AND a.bill_no = '$bill_no' "); 

            return $sql->row();

        }

        public function f_get_billCollectionEdit_saleAmount($sl_no, $bill_no)
        {

            $sql = $this->db->query(" SELECT b.tot_amount FROM td_stn_collection a, td_stn_saleBill b
                                    WHERE a.order_no = b.order_no
                                    AND a.bill_no = b.bill_no
                                    AND a.sl_no = $sl_no
                                    AND a.bill_no = '$bill_no' ");
            return $sql->row();

        }

        public function updateCollection($sl_no, $trans_dt, $order_no, $bill_no, $mode, $ref_no, $amount, $remarks, $modified_by, $modified_dt )
        {

            $value = array('trans_dt' => $trans_dt,
                            'order_no' => $order_no,
                            'mode' => $mode,
                            'ref_no' => $ref_no,
                            'amount' => $amount,
                            'remarks' => $remarks,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt );

            $this->db->where('sl_no', $sl_no);
            $this->db->where('bill_no', $bill_no);
            $this->db->update('td_stn_collection', $value);

        }


        public function deleteBillCollection($sl_no, $bill_no)
        {

            $sql = $this->db->query(" DELETE FROM td_stn_collection WHERE sl_no = $sl_no AND bill_no = '$bill_no' ");

        }


    // **************** For Transaction / Payment *************************** //

        public function f_get_payment_tableData()
        {

            $sql = $this->db->query(" SELECT * FROM td_stn_payment ");
            return $sql->result();

        }

        public function js_get_payment_orderForProject($project_cd) // FOR JS 
        {

            $sql = $this->db->query(" SELECT DISTINCT b.order_no FROM td_stn_order a, td_stn_purchaseBill b WHERE a.c_order_no = b.order_no
                                    AND a.project_cd = $project_cd ");
            return $sql->result();

        }

        public function js_get_Payment_supplierForBill($order_no) // For JS
        {

            $sql = $this-> db->query(" SELECT b.name AS supplier FROM td_stn_order a, md_stn_supplier b
                                    WHERE a.supplier_cd = b.sl_no AND a.c_order_no = '$order_no' ");
            return $sql->row();

        }

        public function js_get_payment_billForOrder($order_no) // For JS
        {

            $sql = $this->db->query(" SELECT bill_no FROM td_stn_purchaseBill WHERE order_no = '$order_no' ");
            return $sql->result();

        }

        public function js_get_payment_amountForBill($bill_no) // For JS
        {

            $sql = $this->db->query(" SELECT tot_amount AS amount FROM td_stn_purchaseBill WHERE bill_no = '$bill_no' ");
            return $sql->row();

        }

        public function addNewPayment($trans_dt, $order_no, $bill_no, $part, $mode, $ref_no, $amount, $remarks, $created_by, $created_dt )
        {

            $value = array('trans_dt' => $trans_dt,
                            'order_no' => $order_no,
                            'bill_no' => $bill_no,
                            'part' => $part,
                            'mode' => $mode,
                            'ref_no' => $ref_no,
                            'amount' => $amount,
                            'remarks' => $remarks,
                            'created_by' => $created_by,
                            'created_dt' => $created_dt );
            
            $this->db->insert('td_stn_payment', $value);              

        }


        public function f_get_payment_editData($sl_no, $bill_no)
        {

            $sql = $this->db->query(" SELECT * FROM td_stn_payment WHERE sl_no = $sl_no AND bill_no = '$bill_no' ");
            return $sql->result();

        }

        public function f_get_billAmount_editData($bill_no)
        {

            $sql = $this->db->query(" SELECT tot_amount FROM td_stn_purchaseBill WHERE bill_no = '$bill_no' ");
            return $sql->row();

        }

        public function f_get_payment_orderNo($sl_no, $bill_no)
        {

            $sql = $this->db->query(" SELECT order_no FROM td_stn_payment WHERE sl_no = $sl_no AND bill_no = '$bill_no' ");
            return $sql->row();

        }

        public function f_get_payment_supplier_editData($order_no)
        {

            $sql = $this->db->query(" SELECT b.name FROM td_stn_order a, md_stn_supplier b WHERE
                                    a.supplier_cd = b.sl_no AND
                                    a.c_order_no = '$order_no' ");
            return $sql->row();

        }

        public function f_get_payment_project_editData($order_no)
        {

            $sql = $this->db->query(" SELECT b.name FROM td_stn_order a, md_stn_project b WHERE 
                                    a.project_cd = b.project_cd AND 
                                    a.c_order_no = '$order_no' ");
            return $sql->row();

        }

        public function updateBillPayment($sl_no, $trans_dt, $order_no, $bill_no, $part, $mode, $ref_no, $amount, $remarks, $modified_by, $modified_dt )
        {

            $value = array('trans_dt' => $trans_dt,
                            'order_no' => $order_no,
                            'bill_no' => $bill_no,
                            'part' => $part,
                            'mode' => $mode,
                            'ref_no' => $ref_no,
                            'amount' => $amount,
                            'remarks' => $remarks,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt );
            
            $this->db->where('sl_no', $sl_no);            
            $this->db->update('td_stn_payment', $value);

        }

        public function deleteBillPayment($sl_no, $bill_no)
        {

            $sql = $this->db->query(" DELETE FROM td_stn_payment WHERE sl_no = '$sl_no' AND bill_no = '$bill_no' ");

        }

        public function f_get_collection_reportData($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT a.trans_dt, a.order_no, a.bill_no, a.amount, a.mode, b.tot_amount, c.name FROM
                                    td_stn_collection a, td_stn_order b, md_stn_project c WHERE
                                    a.order_no = b.c_order_no AND
                                    b.project_cd = c.project_cd AND
                                    a.trans_dt >= '$startDt' AND a.trans_dt <= '$endDt'  ");
            return $sql->result();

        }

        public function f_get_totCollection_Data($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(amount) AS amount FROM td_stn_collection WHERE 
                                    trans_dt >= '$startDt' AND trans_dt <= '$endDt' ");
            return $sql->row();

        }

        public function f_get_payment_reportData($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT a.trans_dt, a.order_no, a.bill_no, a.part, a.amount, a.mode, c.name FROM
                                    td_stn_payment a, td_stn_order b, md_stn_supplier c WHERE
                                    a.order_no = b.c_order_no AND
                                    b.supplier_cd = c.sl_no AND
                                    a.trans_dt >= '$startDt' AND a.trans_dt <= '$endDt' ");
            return $sql->result();

        }

        public function f_get_totPayment_Data($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(amount) AS amount FROM td_stn_payment WHERE trans_dt >= '$startDt' AND trans_dt <= '$endDt' ");
            return $sql->row();

        }

        public function f_get_supplierDetails()
        {

            $sql = $this->db->query(" SELECT * FROM md_stn_supplier
                                      where renewal = 1 ");
            return $sql->result();

        }

        public function f_get_renewalData()
        {

            $sql = $this->db->query(" SELECT sl_no, name, contact_person, renewal FROM md_stn_supplier ");
            return $sql->result();

        }
        

        public function f_get_byDateRenReport($curr_dt)
        {

            $sql = $this->db->query(" SELECT * FROM `td_stm_renewal` 
                                    WHERE effective_dt <= (SELECT max(effective_dt)
                                    from   td_stm_renewal
                                    where  effective_dt <= '$curr_dt') ");

            return $sql->result();

        }


        public function f_get_projectReportData()
        {

            $sql = $this->db->query(" SELECT a.name AS project, a.phn_no, a.address, GROUP_CONCAT(c.name) AS suppliers 
                                    FROM md_stn_project a, md_stn_project_dtls b, md_stn_supplier c
                                    WHERE a.project_cd = b.project_cd
                                    AND b.supplier_cd = c.sl_no 
                                    GROUP BY a.name, a.phn_no, a.address ");
            
            return $sql->result();

        }










    }

?>