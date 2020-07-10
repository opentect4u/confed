<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

    class SocialW extends CI_Model
    {

    // ********* For Product Master ******* //

        public function f_get_item_table()
        {

            $sql = $this->db->query(" SELECT * FROM md_sw_product ");
            return $sql->result();

        }

        public function js_get_check_duplicateItem($hsn_no)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS num_row FROM md_sw_product WHERE hsn_no = '$hsn_no' ");
            return $sql->row();

        }

        public function addNewItem($hsn_no, $item_name, $unit, $created_by, $created_dt)
        {

            $value = array('hsn_no' => $hsn_no,
                        'item_name' => $item_name,
                        'unit' => $unit,
                        'created_by' => $created_by,
                        'created_dt' => $created_dt );
            
            $this->db->insert('md_sw_product',$value);                        

        }

        public function f_get_item_editData($hsn_no)
        {

            $sql = $this->db->query(" SELECT * FROM md_sw_product WHERE hsn_no = $hsn_no ");
            return $sql->result();

        }

        public function updateNewItem($hsn_no, $item_name, $unit, $modified_by, $modified_dt)
        {

            $value = array( 'item_name' => $item_name,
                            'unit' => $unit,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt );
            
            $this->db->where('hsn_no', $hsn_no); 
            $this->db->update('md_sw_product',$value);

        }

    // ********** For Project Master *************** //
        
        public function f_get_projectData()
        {

            $sql = $this->db->query(" SELECT * FROM md_sw_project a, md_district b
                                    WHERE a.dist_cd = b.district_code ");
            return $sql->result();

        }

        public function f_get_distData()
        {

            $sql = $this->db->query(" SELECT * FROM md_district ");
            return $sql->result();

        }

        public function js_get_projectName($disCd)
        {

            $sql = $this->db->query(" SELECT sl_no, cdpo FROM md_sw_project WHERE dist_cd = $disCd ");
            return $sql->result();

        }  

        public function f_get_projectSlNo_max()
        {

            $sql = $this->db->query(" SELECT MAX(sl_no) AS sl_no FROM md_sw_project ");
            return $sql->row();

        }

        public function addNewProject($sl_no, $cdpo, $dist_cd, $contact_no, $address, $created_by, $created_dt)
        {

            $value = array('sl_no' => $sl_no,
                        'cdpo' => $cdpo,
                        'dist_cd' => $dist_cd,
                        'contact_no' => $contact_no,
                        'address' => $address,
                        'created_by' => $created_by,
                        'created_dt' => $created_dt );
            
            $this->db->insert('md_sw_project',$value); 

        }


        public function f_get_project_distData($sl_no, $cdpo)
        {

            $sql = $this->db->query(" SELECT * FROM md_sw_project a, md_district b
                                    WHERE a.dist_cd = b.district_code
                                    AND a.sl_no = $sl_no
                                    AND a.cdpo = '$cdpo' ");

            return $sql->result();

        }

        public function updateNewProject($sl_no, $cdpo, $dist_cd, $contact_no, $address, $modified_by, $modified_dt)
        {

            $value = array('cdpo' => $cdpo,
                            'dist_cd' => $dist_cd,
                            'contact_no' => $contact_no,
                            'address' => $address,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt);

            $this->db->where('sl_no', $sl_no); 
            $this->db->update('md_sw_project',$value);

        }

    // ************* For Vendor Master *************** //

        public function f_get_vendorData()
        {

            $sql = $this->db->query(" SELECT * FROM md_sw_vendor ");
            return $sql->result();

        }

        public function f_get_vendorSlNo_max()
        {

            $sql = $this->db->query(" SELECT MAX(sl_no) AS sl_no FROM md_sw_vendor ");
            return $sql->row();

        }

        public function addNewVendor($sl_no, $vendor_name, $contact_no, $email_id, $address, $created_by, $created_dt)
        {

            $value = array('sl_no' => $sl_no,
                            'vendor_name' => $vendor_name,
                            'contact_no' => $contact_no,
                            'email_id' => $email_id,
                            'address' => $address,
                            'created_by' => $created_by,
                            'created_dt' => $created_dt );

            $this->db->insert('md_sw_vendor',$value); 
            
        }

        public function f_get_vendor_editData($sl_no)
        {

            $sql = $this->db->query(" SELECT * FROM md_sw_vendor WHERE sl_no = $sl_no ");
            return $sql->result();

        }
        
        public function updateNewVendor($sl_no, $vendor_name, $contact_no, $email_id, $address, $modified_by, $modified_dt)
        {

            $value = array('vendor_name' => $vendor_name,
                            'email_id' => $email_id,
                            'contact_no' => $contact_no,
                            'address' => $address,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt);

            $this->db->where('sl_no', $sl_no); 
            $this->db->update('md_sw_vendor',$value);

        }


     //**************** For Rate Master ********************//

        public function f_get_rateChartData()
        {

            $sql = $this->db->query(" SELECT * FROM md_sw_rateChart a, md_sw_product b
                                    WHERE a.hsn_no = b.hsn_no ");
            return $sql->result();

        }

        public function f_get_rateChart_productData()
        {

            $sql = $this->db->query(" SELECT hsn_no, item_name FROM md_sw_product ");
                                    
            return $sql->result();

        }

        public function js_get_productUnit($hsn_no)
        {

            $sql = $this->db->query(" SELECT unit FROM md_sw_product WHERE hsn_no = $hsn_no ");
            return $sql->row();

        }

        public function f_get_rateChartSlNo_max()
        {

            $sql = $this->db->query(" SELECT MAX(sl_no) AS sl_no FROM md_sw_rateChart ");
            return $sql->row();

        }

        public function addNewRate($sl_no, $from_dt, $to_dt, $hsn_no, $unit, $rate, $margin, $gst, $created_by, $created_dt, $rate_count)
        {

            for($j=0; $j<$rate_count; $j++)
            {
                $value1 = array('sl_no' => $sl_no,
                                'from_dt' => $from_dt,
                                'to_dt' => $to_dt,
                                'hsn_no' => $hsn_no[$j],
                                'unit' => $unit[$j],
                                'rate' => $rate[$j],
                                'margin' => $margin[$j],
                                'gst' => $gst[$j],
                                'created_by' => $created_by,
                                'created_dt' => $created_dt);

                $this->db->insert('md_sw_rateChart', $value1);
                $sl_no = $sl_no + 1;
            }
            
            
        }

        public function f_get_rate_editData($sl_no, $hsn_no)
        {

            $sql = $this->db->query(" SELECT * FROM md_sw_rateChart a, md_sw_product b WHERE a.hsn_no = b.hsn_no
                                    AND a.sl_no = $sl_no AND a.hsn_no = $hsn_no ");

            return $sql->result();

        }

        public function updateNewRate($sl_no, $from_dt, $to_dt, $hsn_no, $unit, $rate, $margin, $gst, $modified_by, $modified_dt)
        {

            $value = array('from_dt' => $from_dt,
                            'to_dt' => $to_dt,
                            'hsn_no' => $hsn_no,
                            'unit' => $unit,
                            'rate' => $rate,
                            'margin' => $margin,
                            'gst' => $gst,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt);

            $this->db->where('sl_no', $sl_no); 
            $this->db->update('md_sw_rateChart',$value);

        }



    /////////////////////////////////////////////////////////////////////////////////
    // *********************** For Transaction Part ****************************** //
    /////////////////////////////////////////////////////////////////////////////////

        public function f_get_supplyOrder_tableData()
        {

            $sql = $this->db->query(" SELECT a.order_no, a.order_dt, b.district_name, c.cdpo, a.project_no
            FROM td_sw_supply_order a, md_district b, md_sw_project c
            WHERE a.dist_cd = b.district_code AND a.project_no = c.sl_no
            GROUP BY a.order_no, a.order_dt, b.district_name, c.cdpo, a.project_no 
            order by a.order_dt,a.order_no
                                     ");

            return $sql->result();

        }

        public function js_get_order_projectName($order_no)
        {

            //$sql = $this->db->query(" SELECT sl_no, cdpo FROM md_sw_project WHERE dist_cd = $dist_cd ");
            $sql = $this->db->query(" SELECT DISTINCT a.dist_cd, a.project_no, b.district_name, c.cdpo FROM td_sw_supply_order a, md_district b, md_sw_project c 
                                    WHERE a.dist_cd = b.district_code 
                                    AND a.project_no = c.sl_no
                                    AND b.district_code = c.dist_cd
                                    AND a.order_no = '$order_no' ");
            return $sql->result();

        }

        public function js_get_orderNo_forNewOrderEntry($order_no)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS num_row FROM td_sw_supply_order WHERE order_no = '$order_no' ");
            return $sql->row();

        }

        public function js_get_order_details_forexistOrder_entry($order_no)
        {

            $sql = $this->db->query(" SELECT DISTINCT a.dist_cd, a.project_no, b.district_name, c.cdpo FROM td_sw_supply_order a, md_district b, md_sw_project c WHERE a.dist_cd = b.district_code
                                    AND a.project_no = c.sl_no
                                    AND a.order_no = '$order_no' 
                                    AND a.order_dt = (SELECT MAX(order_dt) FROM td_sw_supply_order WHERE order_no = '$order_no' ) ");
            
            return $sql->result();

        }

        public function f_get_orderSlNo_max()
        {

            $sql = $this->db->query(" SELECT MAX(sl_no) AS sl_no FROM td_sw_supply_order ");
            return $sql->row();

        }

        public function addNewOrder($sl_no, $order_dt, $order_no, $dist_cd, $project_no, $hsn_no, $allot_qty, $item_count, $created_by, $created_dt, $modified_by, $modified_dt)
        {

            for($i=0; $i<$item_count; $i++)
            {
            
                $value = array('sl_no' => $sl_no,
                                'order_dt' => $order_dt,
                                'order_no' => $order_no,
                                'dist_cd' => $dist_cd,
                                'project_no' => $project_no,
                                'hsn_no' => $hsn_no[$i],
                                'allot_qty' => $allot_qty[$i],
                                'created_by' =>  $created_by,
                                'created_dt' => $created_dt,
                                'modified_by' => $modified_by,
                                'modified_dt' => $modified_dt );

                $this->db->insert('td_sw_supply_order', $value);
                $sl_no = $sl_no + 1;

            }


        }

        public function f_get_orderEditData($order_no, $order_dt, $project_no)
        {

            $sql = $this->db->query(" SELECT DISTINCT a.order_no, a.order_dt, a.dist_cd, a.project_no, b.district_name, c.cdpo 
                                    FROM td_sw_supply_order a, md_district b, md_sw_project c
                                    WHERE a.dist_cd = b.district_code AND a.project_no = c.sl_no AND
                                    a.order_no = '$order_no' AND a.order_dt = '$order_dt' AND a.project_no = $project_no ");

            return $sql->result();

        }

        public function f_get_orderEdit_allotment($order_no, $order_dt, $project_no)
        {

            $sql = $this->db->query(" SELECT a.hsn_no, a.allot_qty, b.item_name, b.unit FROM td_sw_supply_order a, md_sw_product b
                                    WHERE a.hsn_no = b.hsn_no AND a.order_no = '$order_no' AND a.order_dt = '$order_dt' AND a.project_no = $project_no ");

            return $sql->result();

        }

        public function deleteOrderEntry($order_no, $order_dt, $project_no)
        {

            $sql = $this->db->query(" DELETE FROM td_sw_supply_order WHERE order_no = '$order_no' AND order_dt = '$order_dt' AND project_no = $project_no ");
            
        }


    // **************** Delivery Section ******************* //

        public function f_get_delivery_tableData()
        {

            $sql = $this->db->query(" SELECT a.trans_dt, a.order_no, b.cdpo, a.challan_no, c.item_name, a.del_qty, d.vendor_name, a.sl_no, a.trans_cd
                                    FROM td_sw_delivery a, md_sw_project b, md_sw_product c, md_sw_vendor d WHERE 
                                    a.cdpo_no = b.sl_no AND
                                    a.hsn_no = c.hsn_no AND
                                    a.vendor_cd = d.sl_no
                                    ORDER BY a.trans_dt ");

            return $sql->result();

        }

        public function f_get_vendor_deliveryData()
        {

            $sql = $this->db->query(" SELECT * FROM md_sw_vendor ");
            return $sql->result();

        }

        public function js_get_delivery_orderNo($dist_cd, $project_no)
        {

            $sql = $this->db->query(" SELECT DISTINCT order_no, order_dt FROM td_sw_supply_order WHERE dist_cd = $dist_cd AND project_no = $project_no ");
            return $sql->result();

        }

        public function js_get_delivery_orderDetailsData($order_no)
        {

            $sql = $this->db->query(" SELECT DISTINCT a.order_no, a.order_dt, a.hsn_no, a.allot_qty, b.item_name FROM td_sw_supply_order a, md_sw_product b
                                    WHERE a.hsn_no = b.hsn_no
                                    AND a.order_no = '$order_no' ");
                                    
            return $sql->result();

        }

        public function js_get_delivery_previousDeliveryDetailsData($order_no)
        {

            $sql = $this->db->query(" SELECT a.hsn_no, a.allot_qty, b.item_name, SUM(c.del_qty) AS del_qty FROM td_sw_supply_order a, md_sw_product b, td_sw_delivery c
                                    WHERE a.hsn_no = b.hsn_no
                                    AND a.hsn_no = c.hsn_no
                                    AND a.order_no = c.order_no
                                    AND a.dist_cd = c.dist_cd
                                    AND a.project_no = c.cdpo_no
                                    AND a.order_no = '$order_no'
                                    GROUP BY a.hsn_no, a.dist_cd, a.project_no, a.allot_qty, b.item_name ");

            return $sql->result();

        }


        public function js_get_price_asSBillNo($sBill_data, $order_no)
        {
              
            $sql = $this->db->query(" SELECT SUM(tot_amnt) AS tot_amnt FROM td_sw_sale WHERE bill_no IN $sBill_data AND order_no = '$order_no' ");
            //array_push($a, $sql->row);
            return $sql->row();

        }

        public function js_get_salePrice_asChallanNo($challan_data)
        {

            $sql = $this->db->query(" SELECT SUM(tot_amnt) AS tot_amnt FROM td_sw_sale WHERE challan_no IN $challan_data ");
            return $sql->row();

        }

        public function js_get_item_asPer_orderPorject($order_no)
        {

            $sql = $this->db->query(" SELECT DISTINCT a.hsn_no, b.item_name FROM td_sw_supply_order a, md_sw_product b
                                    WHERE a.hsn_no = b.hsn_no
                                    AND a.order_no = '$order_no' ");
            return $sql->result();

        }

        public function js_get_delivery_allotQty($order_no, $cdpo_no, $hsn_no)
        {

            $sql = $this->db->query(" SELECT allot_qty FROM td_sw_supply_order WHERE 
                                    order_no = '$order_no' AND
                                    project_no = $cdpo_no AND
                                    hsn_no = $hsn_no  ");

            return $sql->result();

        }

        public function js_get_deliveredQty_asPer_orderItem($order_no, $cdpo_no, $hsn_no)
        {

            $sql = $this->db->query(" SELECT SUM(del_qty) AS totDelivered FROM td_sw_delivery WHERE order_no = '$order_no' AND hsn_no = $hsn_no AND cdpo_no = $cdpo_no ");

            return $sql->row();

        }

        public function js_get_marginGST_forProduct_priceCalculation($hsn_no, $del_dt)
        {

            $sql = $this->db->query(" SELECT margin, gst, rate FROM md_sw_rateChart WHERE hsn_no = $hsn_no AND
                                    to_dt >= '$del_dt' AND from_dt <= '$del_dt' ");
            return $sql->result();

        }

        public function f_get_deliverySlNo_max()
        {

            $sql = $this->db->query(" SELECT MAX(sl_no) AS sl_no FROM td_sw_delivery ");
            return $sql->row();

        }

        public function f_get_deliveryTransCd_max($trans_dt)
        {

            $sql = $this->db->query(" SELECT MAX(trans_cd) AS trans_cd FROM td_sw_delivery WHERE trans_dt = '$trans_dt' ");
            return $sql->row();

        }


        public function addNewDelivery( $sl_no, $trans_dt, $trans_cd, $dist_cd, $order_no, $cdpo_no, $challan_no, $hsn_no, $del_qty, $vendor_cd, $purchase_dt, $pb_no, $tax_val, $cgst, $sgst, $tot_amnt, $created_by, $created_dt )
        {

            $value = array('sl_no' => $sl_no,
                                'trans_dt' => $trans_dt,
                                'trans_cd' => $trans_cd,
                                'dist_cd' => $dist_cd,
                                'order_no' => $order_no,
                                'cdpo_no' => $cdpo_no,
                                'challan_no' => $challan_no,
                                'hsn_no' => $hsn_no,
                                'del_qty' => $del_qty,
                                'vendor_cd' => $vendor_cd,
                                'purchase_dt' => $purchase_dt,
                                'pb_no' => $pb_no,
                                'tax_val' => $tax_val,
                                'cgst' => $cgst,
                                'sgst' => $sgst,
                                'tot_amnt' => $tot_amnt,
                                'created_by' =>  $created_by,
                                'created_dt' => $created_dt );

                $this->db->insert('td_sw_delivery', $value);
               

        }

        public function f_get_delivery_editData($sl_no, $trans_dt, $trans_cd)
        {

            $sql = $this->db->query(" SELECT DISTINCT a.sl_no as sl_no, a.trans_cd, a.trans_dt, a.dist_cd, b.district_name, a.order_no, c.order_dt, a.cdpo_no, 
                                    d.cdpo, a.challan_no, a.hsn_no, e.item_name, a.del_qty, a.vendor_cd, f.vendor_name, a.purchase_dt, a.pb_no, a.tax_val, a.cgst, a.sgst, a.tot_amnt
                                    FROM td_sw_delivery a, md_district b, td_sw_supply_order c, md_sw_project d, md_sw_product e, md_sw_vendor f 
                                    WHERE a.dist_cd = b.district_code 
                                    AND a.order_no = c.order_no 
                                    AND a.cdpo_no = d.sl_no 
                                    AND a.hsn_no = e.hsn_no 
                                    AND a.vendor_cd = f.sl_no
                                    AND a.sl_no = $sl_no 
                                    AND a.trans_dt = '$trans_dt' 
                                    AND a.trans_cd = $trans_cd ");
            
            return $sql->result();

        }
        
        public function f_get_delivery_allotQtyData($sl_no, $trans_dt, $trans_cd)
        {

            $sql = $this->db->query(" SELECT b.allot_qty FROM td_sw_delivery a, td_sw_supply_order b
                                    WHERE a.order_no = b.order_no
                                    AND a.dist_cd = b.dist_cd
                                    AND a.cdpo_no = b.project_no
                                    AND a.hsn_no = b.hsn_no
                                    AND a.sl_no = $sl_no
                                    AND a.trans_dt = '$trans_dt'
                                    AND a.trans_cd = $trans_cd ");

            return $sql->row();

        }

        public function f_get_delivery_tot_delQtyData($sl_no, $trans_dt, $trans_cd)
        {

            $sql = $this->db->query(" SELECT SUM(del_qty) AS tot_del FROM td_sw_delivery WHERE sl_no != $sl_no AND trans_dt = '$trans_dt' AND trans_cd = $trans_cd  ");
            return $sql->row();

        }

        public function f_get_edit_undeliveredDetails($sl_no, $trans_dt, $trans_cd)
        {

            $sql = $this->db->query(" SELECT order_no, dist_cd, cdpo_no, hsn_no FROM td_sw_delivery 
                                    WHERE sl_no = $sl_no
                                    AND trans_dt = '$trans_dt'
                                    AND trans_cd = $trans_cd ");
            
            return $sql->result();

        }

        public function f_get_edit_alreadyDelivered_qTy($order_no, $dist_cd, $cdpo_no, $hsn_no, $trans_dt, $trans_cd)
        {

            $sql = $this->db->query(" SELECT SUM(del_qty) AS del_qty FROM td_sw_delivery WHERE order_no = '$order_no' AND dist_cd = $dist_cd AND cdpo_no = $cdpo_no
                                    AND hsn_no = $cdpo_no AND trans_dt != '$trans_dt' AND trans_cd != $trans_cd ");
            return $sql->row();

        }

        public function updateNewDelivery( $sl_no, $trans_dt, $trans_cd, $del_qty, $purchase_dt, $pb_no, $tax_val, $cgst, $sgst, $tot_amnt, $modified_by, $modified_dt )
        {

            $value = array('sl_no' => $sl_no,
                                'trans_dt' => $trans_dt,
                                'trans_cd' => $trans_cd,
                                'del_qty' => $del_qty,
                                'purchase_dt' => $purchase_dt,
                                'pb_no' => $pb_no,
                                'tax_val' => $tax_val,
                                'cgst' => $cgst,
                                'sgst' => $sgst,
                                'tot_amnt' => $tot_amnt,
                                'modified_by' => $modified_by,
                                'modified_dt' => $modified_dt );

            $this->db->where('sl_no', $sl_no); 
            $this->db->where('trans_dt', $trans_dt); 
            $this->db->where('trans_cd', $trans_cd); 

            $this->db->update('td_sw_delivery',$value);

        }

        public function f_delete_delivery($trans_dt, $trans_cd)
        {

            //$sql = $this->db->query(" DELETE FROM td_sw_delivery WHERE 'sl_no' = $sl_no AND trans_dt = '$trans_dt'AND trans_cd = $trans_cd ");

            $this->db->where('trans_dt', $trans_dt);
            $this->db->where('trans_cd ', $trans_cd );

            $this->db->delete('td_sw_delivery');

        }



    // ********************* For Sale Section ********************* //

        public function f_get_sale_tableData()
        {

            $sql = $this->db->query(" SELECT a.sl_no, a.trans_dt, a.trans_cd, b.district_name, a.order_no, c.cdpo, a.challan_no, 
                                    d.item_name, a.tot_amnt FROM
                                    td_sw_sale a, md_district b, md_sw_project c, md_sw_product d
                                    WHERE a.dist_cd = b.district_code AND a.cdpo_no = c.sl_no AND a.hsn_no = d.hsn_no ORDER BY b.district_code,a.trans_dt ");

            return $sql->result();

        }

        public function js_get_sale_challanNo($dist_cd, $project_no, $order_no )
        {

            $sql = $this->db->query(" SELECT challan_no, trans_dt FROM td_sw_delivery WHERE dist_cd = $dist_cd AND
                                    order_no = '$order_no' AND cdpo_no = $project_no ");
            return $sql->result();

        }

        public function js_get_item_forSale_orderChallan($dist_cd, $project_no, $order_no, $challan )
        {

            $sql = $this->db->query(" SELECT a.hsn_no, b.item_name FROM td_sw_delivery a, md_sw_product b WHERE a.hsn_no = b.hsn_no
                                    AND a.dist_cd = $dist_cd AND a.cdpo_no = $project_no AND a.order_no = '$order_no' AND a.challan_no = '$challan' ");
            return $sql->result();

        }

        public function js_get_sale_delQty($dist_cd, $project_no, $order_no, $challan_no, $hsn_no )
        {

            $sql = $this->db->query(" SELECT SUM(del_qty) AS del_qty FROM td_sw_delivery WHERE dist_cd = $dist_cd
                                    AND cdpo_no = $project_no AND order_no = '$order_no' AND challan_no = $challan_no AND hsn_no = $hsn_no
                                    GROUP BY dist_cd, cdpo_no, order_no, challan_no, hsn_no ");
            return $sql->row();

        }

        public function js_get_sale_deliveryInfoTableData_challan($order_no)
        {

            $sql = $this->db->query(" SELECT a.challan_no, a.del_qty, b.item_name FROM td_sw_delivery a, md_sw_product b
                                    WHERE a.hsn_no = b.hsn_no
                                    AND a.order_no = '$order_no' ");
                                    
            return $sql->result();

        }

        public function f_get_transDt_hsnNo_perChallanNo($challan_no, $order_no)
        {

            $sql = $this->db->query(" SELECT trans_dt, hsn_no, del_qty FROM td_sw_delivery WHERE challan_no = '$challan_no' AND order_no = '$order_no' ");
            return $sql->result();

        }

        public function js_check_sale_duplicate_billEntry($order_no, $challan_no, $bill_no)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS num_row FROM td_sw_sale WHERE order_no = '$order_no' AND challan_no = '$challan_no' AND bill_no = $bill_no ");
            return $sql->row();

        }

        public function js_get_sale_challan_nos($order_no)
        {

            $sql = $this->db->query(" SELECT DISTINCT challan_no FROM td_sw_delivery WHERE order_no = '$order_no' ");
            return $sql->result();

        }

        public function js_get_sale_itemPer_challan($challan_no, $order_no)
        {

            $sql = $this->db->query(" SELECT a.hsn_no, b.item_name FROM td_sw_delivery a, md_sw_product b WHERE 
                                    a.hsn_no = b.hsn_no 
                                    AND a.challan_no = '$challan_no'
                                    AND a.order_no = '$order_no' ");
            return $sql->result();

        }

        public function js_get_sale_delQty_perChallan($challan_no, $order_no)
        {

            $sql = $this->db->query(" SELECT SUM(del_qty) AS del_qty FROM td_sw_delivery WHERE 
                                    order_no = '$order_no' AND challan_no = '$challan_no' ");
            return $sql->row();

        }

        public function js_get_payment_saleBillDtls($order_no)
        {

            $sql = $this->db->query(" SELECT a.bill_no, a.tot_amnt, b.item_name FROM td_sw_sale a, md_sw_product b
                                    WHERE a.hsn_no = b.hsn_no
                                    AND a.order_no = '$order_no' ");
                                    
            return $sql->result();

        }

        public function js_get_payment_purchaseBillDtls($order_no)
        {

            $sql = $this->db->query(" SELECT a.pb_no, a.tot_amnt, b.item_name FROM td_sw_delivery a, md_sw_product b
                                    WHERE a.hsn_no = b.hsn_no
                                    AND a.order_no = '$order_no' ");
            return $sql->result();

        }

        public function js_get_payment_districtProject_forOrder($order_no)
        {

            $sql = $this->db->query(" SELECT a.dist_cd, a.cdpo_no, b.district_name, c.cdpo FROM td_sw_sale a, md_district b, md_sw_project c
                                    WHERE a.dist_cd = b.district_code
                                    AND a.cdpo_no = c.sl_no
                                    AND a.order_no = '$order_no' ");
            return $sql->result();

        }

        public function f_get_saleSlNo_max()
        {

            $sql = $this->db->query(" SELECT MAX(sl_no) AS sl_no FROM td_sw_sale ");
            return $sql->row();

        }

        public function f_get_saleTransCd_max($trans_dt)
        {

            $sql = $this->db->query(" SELECT MAX(trans_cd) AS trans_cd FROM td_sw_sale WHERE trans_dt = '$trans_dt' ");
            return $sql->row();

        }

        public function addSaleEntry( $sl_no, $trans_dt, $trans_cd, $dist_cd, $cdpo_no, $order_no, $challan_no, $hsn_no, $sale_dt, $bill_no, $cgst, $sgst, $tax_val, $tot_amnt, $created_by, $created_dt )
        {

            $value = array('sl_no' => $sl_no,
                                'trans_dt' => $trans_dt,
                                'trans_cd' => $trans_cd,
                                'dist_cd' => $dist_cd,
                                'order_no' => $order_no,
                                'cdpo_no' => $cdpo_no,
                                'challan_no' => $challan_no,
                                'hsn_no' => $hsn_no,
                                'sale_dt' => $sale_dt,
                                'bill_no' => $bill_no,
                                'tax_val' => $tax_val,
                                'cgst' => $cgst,
                                'sgst' => $sgst,
                                'tot_amnt' => $tot_amnt,
                                'created_by' =>  $created_by,
                                'created_dt' => $created_dt );

                $this->db->insert('td_sw_sale', $value);

        }

        public function f_get_sale_editData($sl_no, $trans_dt, $trans_cd)
        {

            $sql = $this->db->query(" SELECT a.sl_no, a.trans_dt, a.trans_cd, a.trans_dt, a.dist_cd, b.district_name, a.order_no, 
                                    a.cdpo_no , c.cdpo, a.challan_no, a.hsn_no, d.item_name, a.bill_no,
                                    a.sale_dt, a.tax_val, a.cgst, a.sgst, a.tot_amnt FROM 
                                    td_sw_sale a, md_district b, md_sw_project c, md_sw_product d
                                    WHERE a.dist_cd = b.district_code AND a.cdpo_no = c.sl_no AND a.hsn_no = d.hsn_no
                                    AND a.sl_no = $sl_no AND a.trans_dt = '$trans_dt' AND a.trans_cd = $trans_cd  ");

            return $sql->result();

        }

        public function f_get_sale_delQty_editData($sl_no, $trans_dt, $trans_cd)
        {

            $sql = $this->db->query(" SELECT SUM(b.del_qty) AS del_qty FROM td_sw_sale a, td_sw_delivery b 
                                    WHERE a.dist_cd = b.dist_cd AND a.order_no = b.order_no AND a.cdpo_no = b.cdpo_no AND 
                                    a.challan_no = b.challan_no AND a.hsn_no = b.hsn_no AND a.sl_no = $sl_no AND a.trans_dt = '$trans_dt' AND a.trans_cd = $trans_cd
                                    GROUP BY a.sl_no, a.trans_dt, a.trans_cd  ");

            return $sql->row();

        }

        public function f_delete_saleData($sl_no, $trans_dt, $trans_cd)
        {

            $this->db->where('sl_no', $sl_no);
            $this->db->where('trans_dt', $trans_dt);
            $this->db->where('trans_cd ', $trans_cd );

            $this->db->delete('td_sw_sale');

        }

    // ****************** For Report Section ***************** //

        public function showDWSaleReport($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT a.sale_dt, b.district_name, a.order_no, c.cdpo, a.challan_no, d.item_name, a.bill_no, a.tax_val, a.cgst, a.sgst, a.tot_amnt
                                    FROM td_sw_sale a, md_district b, md_sw_project c, md_sw_product d 
                                    WHERE a.dist_cd = b.district_code AND a.cdpo_no = c.sl_no AND a.hsn_no = d.hsn_no AND a.sale_dt >= '$startDt' AND a.sale_dt <= '$endDt' ");
                                        

            return $sql->result();

        }

        public function show_total_saleReport($startDt, $endDt)
        {

                $sql = $this->db->query(" SELECT SUM(tot_amnt) AS tot_amnt FROM td_sw_sale WHERE 
                                        sale_dt >= '$startDt' AND sale_dt <= '$endDt' GROUP BY sale_dt ");

                return $sql->row();

        }

        public function f_get_dw_oilPayment_repData($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT a.trans_dt, a.payment_key, a.pb_no, a.pb_dt, a.pb_amnt, a.sb_no, a.sb_dt, a.sb_amnt, a.mr_no
                                    FROM td_sw_payment a, td_sw_delivery b, td_sw_sale c 
                                    WHERE a.pb_no = b.pb_no AND a.sb_no = c.bill_no AND a.pb_dt = b.trans_dt 
                                    AND a.sb_dt = c.trans_dt AND b.challan_no = c.challan_no
                                    AND b.hsn_no = c.hsn_no AND b.hsn_no = '1514' 
                                    AND a.trans_dt <= '$endDt' AND a.trans_dt >= '$startDt' ");

            return $sql->result();

        }

        public function f_get_oil_payment_dtls($payment_key, $hsn_no)
        {

            $sql = $this->db->query(" SELECT a.sl_no, a.pb_no, a.pb_dt, b.del_qty, a.pb_amnt, a.sb_no, a.sb_dt, a.sb_amnt, c.cdpo 
                                    FROM td_sw_payment a, td_sw_delivery b, md_sw_project c 
                                    WHERE a.cdpo_no = b.cdpo_no
                                    AND a.pb_no = b.pb_no
                                    AND a.pb_dt = b.trans_dt
                                    AND b.dist_cd = c.dist_cd
                                    AND b.cdpo_no = c.sl_no
                                    AND a.payment_key = '$payment_key'
                                     ");

            return $sql->result();

        }

        public function f_get_oil_payment_shortage_dtls($payment_key)
        {

            $sql = $this->db->query(" SELECT shortage, oil_shortage, tot_payable, tot_rcv 
                                    FROM td_sw_shortage WHERE payment_key = '$payment_key' ");
            return $sql->result();

        }

        public function f_get_oil_payment_total($payment_key, $hsn_no)
        {

            $sql = $this->db->query(" SELECT SUM(b.del_qty) AS del_qty, SUM(a.pb_amnt) AS pb_amnt, SUM(a.sb_amnt) AS sb_amnt FROM td_sw_payment a, td_sw_delivery b 
                                    WHERE a.cdpo_no = b.cdpo_no 
                                    AND a.pb_no = b.pb_no 
                                    AND a.payment_key = '$payment_key'
                                     ");

            return $sql->result();

        }

        public function f_get_oil_paymentDtls_data($payment_key)
        {

            $sql = $this->db->query(" SELECT a.trans_dt, a.cr_dt, a.mr_no, a.amnt_cr, a.amnt_oil, b.bank_name, d.cdpo
                                    FROM td_sw_payment_dtls a, md_bank b, td_sw_payment c, md_sw_project d
                                    WHERE a.bank = b.sl_no 
                                    AND a.mr_no = c.mr_no
                                    AND c.cdpo_no = d.sl_no 
                                    AND a.payment_key = '$payment_key' ");

            return $sql->result();

        }

        public function get_paymentSheet_gstDt($payment_key)
        {

            $sql = $this->db->query(" SELECT b.trans_dt FROM td_sw_payment a, td_sw_delivery b 
                                    WHERE a.cdpo_no = b.cdpo_no
                                    AND a.pb_no = b.pb_no
                                    AND a.pb_dt = b.trans_dt
                                    AND a.payment_key = '$payment_key' ");

            return $sql->row();

        }

        public function f_get_oil_payment_gstRate($trans_dt, $hsn_no)
        {

            $sql = $this->db->query(" SELECT rate FROM md_sw_rateChart WHERE 
                                    hsn_no = '$hsn_no' AND from_dt <= '$trans_dt' AND to_dt >= '$trans_dt' ");

            return $sql->row();
            
        }

        public function f_get_oil_payment_gstDtls($payment_key, $hsn_no, $trans_dt)
        {

            $sql = $this->db->query(" SELECT c.gst, SUM(b.del_qty) AS del_qty 
                                    FROM td_sw_payment a, td_sw_delivery b, md_sw_rateChart c 
                                    WHERE a.cdpo_no = b.cdpo_no 
                                    AND a.pb_no = b.pb_no 
                                    AND a.pb_dt = b.trans_dt 
                                    AND b.hsn_no = c.hsn_no 
                                    AND b.hsn_no = '$hsn_no'
                                    AND c.from_dt <= '$trans_dt' 
                                    AND c.to_dt >= '$trans_dt' 
                                    AND a.payment_key = '$payment_key'
                                    GROUP BY b.cdpo_no, b.pb_no, b.hsn_no, b.trans_dt, c.gst, 
                                    c.from_dt, c.to_dt, a.payment_key, a.cdpo_no, a.pb_no, a.pb_dt ");
            
            
            return $sql->result();

        }

        public function showDWPurchaseReport($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT a.purchase_dt, a.pb_no, b.vendor_name, a.tax_val, a.cgst, a.sgst, a.tot_amnt,
                                    c.district_name, d.cdpo, a.order_no, a.challan_no FROM td_sw_delivery a, md_sw_vendor b, md_district c, md_sw_project d
                                    WHERE a.vendor_cd = b.sl_no AND a.dist_cd = c.district_code AND a.cdpo_no = d.sl_no AND a.purchase_dt >= '$startDt' AND a.purchase_dt <= '$endDt' ");
            
            return $sql->result();

        }


        public function show_total_purchaseReport($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(tot_amnt) AS tot_amnt FROM td_sw_delivery 
                                    WHERE purchase_dt >= '$startDt' AND purchase_dt <= '$endDt' GROUP BY purchase_dt ");

            return $sql->row();

        }

        public function get_bill_tableData()
        {

            $sql = $this->db->query(" SELECT a.trans_dt, a.sl_no, a.payment_key, a.mr_no, a.pb_no, a.sb_no, a.pb_dt, a.sb_dt, a.pb_amnt, a.sb_amnt, c.cdpo
                                    FROM td_sw_payment a, md_sw_project c WHERE a.cdpo_no = c.sl_no ORDER BY a.trans_dt ");
            return $sql->result();

        } 


        public function f_get_paymentTransCd_max($trans_dt)
        {

            $sql = $this->db->query(" SELECT MAX(sl_no) AS sl_no FROM td_sw_payment WHERE trans_dt = '$trans_dt' ");
            return $sql->row();

        }

        public function f_get_payment_paymentKey($currYear)
        {

            //$sql = $this->db->query(" SELECT COUNT(*) AS keyVal FROM `td_sw_payment` WHERE YEAR(trans_dt) = YEAR(CURDATE()) ");
            $sql = $this->db->query(" SELECT MAX(payment_key) AS payment_key FROM td_sw_payment WHERE YEAR(trans_dt) = YEAR(CURDATE()) ");
            return $sql->row();

        }

        public function addPaymentEntry($row, $sl_no, $trans_dt, $paymentKey, $entry_type, $dist_cd, $cdpo, $cdpo_no, $order_no, $pb_no, $pb_dt, $pb_amnt, $hsn_no, $sb_no, $sb_dt, $sb_amnt, $mr_no, $remarks, $created_by, $created_dt)
        {

            for($i =0; $i<$row; $i++)
            {    
                if($entry_type == 1)
                {
                    $value = array( 'sl_no' => $sl_no+$i,
                                'trans_dt' => $trans_dt,
                                'payment_key' => $paymentKey,
                                'cdpo_no' => $cdpo_no[$i],
                                'pb_no' => $pb_no[$i],
                                'pb_dt' => $pb_dt[$i],
                                'pb_amnt' => $pb_amnt[$i],
                                'sb_no' => $sb_no[$i],
                                'sb_dt' => $sb_dt[$i],
                                'sb_amnt' => $sb_amnt[$i],
                                'mr_no' => $mr_no[$i],
                                'remarks' => $remarks,
                                'created_by' => $created_by,
                                'created_dt' => $created_dt );

                }
                else
                {
                    $value = array( 'sl_no' => $sl_no+$i,
                                'trans_dt' => $trans_dt,
                                'payment_key' => $paymentKey,
                                'cdpo_no' => $cdpo[$i],
                                'pb_no' => $pb_no[$i],
                                'pb_dt' => $pb_dt[$i],
                                'pb_amnt' => $pb_amnt[$i],
                                'sb_no' => $sb_no[$i],
                                'sb_dt' => $sb_dt[$i],
                                'sb_amnt' => $sb_amnt[$i],
                                'mr_no' => $mr_no[$i],
                                'remarks' => $remarks,
                                'created_by' => $created_by,
                                'created_dt' => $created_dt );
                }

                //var_dump($sb_dt); die;

                $this->db->insert('td_sw_payment', $value);

            }

        }

        public function f_get_editPaymentData($trans_dt, $sl_no, $payment_key)
        {

            $sql = $this->db->query(" SELECT a.trans_dt, a.sl_no, a.payment_key, a.pb_no, a.pb_dt, a.pb_amnt, a.sb_no, a.sb_dt, a.sb_amnt, a.mr_no, b.cdpo, a.remarks
                                    FROM td_sw_payment a, md_sw_project b WHERE a.cdpo_no = b.sl_no AND a.trans_dt = '$trans_dt' AND a.sl_no = $sl_no AND a.payment_key = '$payment_key' ");
            
            return $sql->result();

        }

        public function UpdatePaymentEntry($trans_dt, $sl_no, $payment_key, $pb_no, $pb_dt, $pb_amnt, $sb_no, $sb_dt, $sb_amnt, $mr_no, $remarks, $modified_by, $modified_dt)
        {

            $value = array( 'pb_no' => $pb_no,
                            'pb_dt' => $pb_dt,
                            'pb_amnt' => $pb_amnt,
                            'sb_no' => $sb_no,
                            'sb_dt' => $sb_dt,
                            'sb_amnt' => $sb_amnt,
                            'mr_no' => $mr_no,
                            'remarks' => $remarks,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt );

            $this->db->where('trans_dt', $trans_dt);
            $this->db->where('sl_no ', $sl_no );
            $this->db->where('payment_key ', $payment_key );

            $this->db->update('td_sw_payment', $value);

        }

        public function deletePaymentEntry($trans_dt, $sl_no, $payment_key)
        {

            $this->db->where('trans_dt', $trans_dt);
            $this->db->where('sl_no', $sl_no);
            $this->db->where('payment_key ', $payment_key );

            $this->db->delete('td_sw_payment'); 

        }

        public function js_get_project_perDistCd($dist_cd)
        {

            $sql = $this->db->query(" SELECT cdpo, sl_no FROM md_sw_project WHERE dist_cd = $dist_cd ");
            return $sql->result();

        }


        public function f_get_challan_forPBNO($pb_no, $pb_dt)
        {

            $sql = $this->db->query(" SELECT dist_cd, order_no, cdpo_no, challan_no FROM td_sw_delivery 
                                    WHERE pb_no = '$pb_no' 
                                    AND purchase_dt = '$pb_dt' ");
            return $sql->result();

        }

        public function js_get_Payment_purchaseSaleAmount_forBillNoDate($challan_no, $cdpo_no, $order_no)
        {

            $sql = $this->db->query(" SELECT a.tot_amnt, a.cdpo_no, a.order_no, b.item_name, c.bill_no AS sb_no, c.sale_dt AS sb_dt, c.tot_amnt AS sb_amnt, d.cdpo
                                    FROM td_sw_delivery a, md_sw_product b, td_sw_sale c, md_sw_project d
                                    WHERE a.hsn_no = b.hsn_no
                                    AND a.challan_no = c.challan_no
                                    AND a.dist_cd = c.dist_cd
                                    AND a.order_no = c.order_no
                                    AND a.cdpo_no = c.cdpo_no
                                    AND a.hsn_no = c.hsn_no
                                    AND a.cdpo_no = d.sl_no
                                    AND a.challan_no = '$challan_no' 
                                    AND a.cdpo_no = '$cdpo_no'
                                    AND a.order_no = '$order_no' ");
            return $sql->result();

        }

        public function f_get_shortageDtls_tableData()
        {

            $sql = $this->db->query(" SELECT trans_dt, payment_key, shortage, oil_shortage 
                                    FROM td_sw_shortage  ");
                                    
            return $sql->result();

        }

        public function f_get_bankName()
        {

            $sql = $this->db->query(" SELECT bank_name, sl_no FROM md_bank ");
            return $sql->result();

        }

        public function js_get_mrNo_perPaymentKey($payment_key)
        {

            $sql = $this->db->query(" SELECT DISTINCT mr_no FROM td_sw_payment WHERE payment_key = '$payment_key' ");
            return $sql->result();

        }

        public function js_get_billAmounts_for_paymentKey($payment_key)
        {

            $sql = $this->db->query(" SELECT SUM(pb_amnt) AS tot_pb_amnt, SUM(sb_amnt) AS tot_sb_amnt FROM td_sw_payment WHERE payment_key = '$payment_key' ");
            return $sql->result();

        }

        public function f_get_maxSlNo_paymentDtls($trans_dt)
        {

            $sql = $this->db->query(" SELECT MAX(sl_no) AS sl_no FROM td_sw_payment_dtls WHERE trans_dt = '$trans_dt' ");
            return $sql->row();

        }

        public function addPaymentDetails($sl_no, $payment_key, $trans_dt, $mr_no, $bank, $amnt_cr, $amnt_oil, $cr_dt, $created_by, $created_dt, $row)
        {

            for($i= 0; $i<$row; $i++)
            {
                $value = array('sl_no' => $sl_no+$i,
                            'payment_key' => $payment_key,
                            'trans_dt' => $trans_dt,
                            'amnt_cr' => $amnt_cr[$i],
                            'amnt_oil' => $amnt_oil[$i],
                            'cr_dt' => $cr_dt[$i],
                            'bank' => $bank[$i],
                            'created_by' => $created_by,
                            'created_dt' => $created_dt );

                $this->db->insert('td_sw_payment_dtls', $value);   
            } 

        }


        public function addShortageDtls($trans_dt, $payment_key, $shortage, $oil_shortage, $tot_payable, $tot_rcv, $remarks, $commission, $created_by, $created_dt)
        {

            $value = array('trans_dt' => $trans_dt,
                            'payment_key' => $payment_key,
                            'shortage' => $shortage,
                            'oil_shortage' => $oil_shortage,
                            'tot_payable' => $tot_payable,
                            'tot_rcv' => $tot_rcv,
                            'remarks' => $remarks,
                            'commission' => $commission,
                            'created_by' => $created_by,
                            'created_dt' => $created_dt);

            $this->db->insert('td_sw_shortage', $value);

        }

        public function f_get_shortageDtls_editData($trans_dt, $payment_key)
        {

            $sql = $this->db->query(" SELECT trans_dt, payment_key, shortage, oil_shortage, tot_payable, tot_rcv, commission, remarks 
                                    FROM td_sw_shortage WHERE trans_dt = '$trans_dt' AND payment_key = '$payment_key' ");
            return $sql->result();

        }


        public function f_get_shortageDtls_totAmnt_editData($payment_key)
        {

            $sql = $this->db->query(" SELECT SUM(pb_amnt) AS pb_amnt, SUM(sb_amnt) AS sb_amnt FROM td_sw_payment WHERE payment_key = '$payment_key' ");
            return $sql->result();

        }

        public function f_get_paymentDtls_editData($trans_dt, $payment_key)
        {

            $sql = $this->db->query(" SELECT a.sl_no, a.mr_no, a.cr_dt, a.amnt_cr, a.amnt_oil, a.bank, b.bank_name FROM td_sw_payment_dtls a, md_bank b
                                    WHERE a.bank = b.sl_no AND a.trans_dt = '$trans_dt' AND a.payment_key = '$payment_key' ");
            return $sql->result();

        }

        public function updateShortageEntry($payment_key, $trans_dt, $shortage, $oil_shortage, $tot_payable, $tot_rcv, $commission, $remarks, $modified_by, $modified_dt )
        {

            $value = array('shortage' => $shortage,
                            'oil_shortage' => $oil_shortage,
                            'tot_payable' => $tot_payable,
                            'tot_rcv' => $tot_rcv,
                            'commission' => $commission,
                            'remarks' => $remarks,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt );

            $this->db->where('payment_key', $payment_key);
            $this->db->where('trans_dt', $trans_dt);
            $this->db->update('td_sw_shortage', $value);

        }

        public function updatePaymentDtlsEntry($sl_no, $payment_key, $trans_dt, $mr_no, $amnt_cr, $amnt_oil, $cr_dt, $bank, $modified_by, $modified_dt, $row )
        {

            for($i= 0; $i<$row; $i++)
            {

                $value = array('sl_no' => $sl_no[$i],
                                'mr_no' => $mr_no[$i],
                                'amnt_cr' => $amnt_cr[$i],
                                'amnt_oil' => $amnt_oil[$i],
                                'cr_dt' => $cr_dt[$i],
                                'bank' => $bank[$i],
                                'modified_by' => $modified_by,
                                'modified_dt' => $modified_dt);
                
                $this->db->where('payment_key', $payment_key);
                $this->db->where('trans_dt', $trans_dt);
                $this->db->update('td_sw_payment_dtls', $value);

            }

        }

        public function deleteShortageEntry($trans_dt, $payment_key)
        {

            $sql = $this->db->query(" DELETE FROM td_sw_shortage WHERE trans_dt = '$trans_dt' AND payment_key = '$payment_key' ");

        }


        public function deletePaymentDtlsEntry($trans_dt, $payment_key)
        {

            $sql = $this->db->query(" DELETE FROM td_sw_payment_dtls WHERE trans_dt = '$trans_dt' AND payment_key = '$payment_key' ");

        }

        public function f_get_deliveryRepData($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT a.trans_dt, a.dist_cd, a.order_no, a.cdpo_no, a.pb_no, a.challan_no, a.hsn_no, a.del_qty,
                                        b.district_name, c.cdpo, d.item_name, d.unit, a.vendor_cd, e.vendor_name FROM td_sw_delivery a, md_district b, md_sw_project c, md_sw_product d, md_sw_vendor e
                                        WHERE a.dist_cd  = b.district_code AND a.cdpo_no = c.sl_no
                                        AND a.hsn_no = d.hsn_no AND a.vendor_cd = e.sl_no AND a.trans_dt >= '$startDt' AND a.trans_dt <= '$endDt' ");
            return $sql->result();

        }


        public function f_get_pwDeliveryData($dist_cd, $cdpo_no)
        {

            $sql = $this->db->query(" SELECT a.order_no, a.challan_no, a.pb_no, a.del_qty, b.cdpo, c.item_name, c.unit, d.vendor_name
                                    FROM td_sw_delivery a, md_sw_project b, md_sw_product c, md_sw_vendor d WHERE 
                                    a.cdpo_no = b.sl_no AND a.hsn_no = c.hsn_no AND a.vendor_cd = d.sl_no
                                    AND a.dist_cd = $dist_cd AND a.cdpo_no = $cdpo_no ");
            return $sql->result();

        }

        public function f_get_pwDeliveryDist($dist_cd)
        {

            $sql = $this->db->query(" SELECT district_name FROM md_district WHERE district_code = $dist_cd ");
            return $sql->row();

        }

        public function f_get_pwDeliveryProject($dist_cd, $cdpo_no)
        {

            $sql = $this->db->query(" SELECT cdpo FROM md_sw_project WHERE sl_no = $cdpo_no AND dist_cd = $dist_cd ");
            return $sql->row();

        }

        public function f_get_supplierData()
        {

            $sql = $this->db->query(" SELECT sl_no, vendor_name FROM md_sw_vendor ");
            return $sql->result();

        }

        public function f_get_deliveryReport_dtls($startDt, $endDt, $vendor_cd)
        {

            $sql = $this->db->query(" SELECT a.trans_dt, a.dist_cd, a.order_no, a.cdpo_no, a.pb_no, a.challan_no, a.hsn_no, a.del_qty,
                                    b.district_name, c.cdpo, d.item_name, d.unit, a.vendor_cd, e.vendor_name FROM td_sw_delivery a, md_district b, md_sw_project c, md_sw_product d, md_sw_vendor e
                                    WHERE a.dist_cd  = b.district_code AND a.cdpo_no = c.sl_no AND a.hsn_no = d.hsn_no AND a.vendor_cd = e.sl_no
                                    AND a.trans_dt >= '$startDt' AND a.trans_dt <= '$endDt' AND a.vendor_cd = $vendor_cd ");
            
            return $sql->result();

        }

        public function f_get_delRep_supplierName($vendor_cd)
        {

            $sql = $this->db->query(" SELECT vendor_name FROM md_sw_vendor WHERE sl_no = $vendor_cd ");
            return $sql->row();

        }

        public function f_get_dwShortageRepData($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT a.trans_dt, a.order_no, a.shortage_amnt, b.district_name, c.cdpo FROM
                                    td_sw_payment a, md_district b, md_sw_project c WHERE 
                                    a.dist_cd = b.district_code AND
                                    a.cdpo_no = c.sl_no AND
                                    a.trans_dt >= '$startDt' AND
                                    a.trans_dt <= '$endDt' ");

            return $sql->result();

        }

        public function f_get_dwTotShortageData($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(shortage_amnt) AS tot_shortage FROM td_sw_payment
                                    WHERE trans_dt >= '$startDt' AND trans_dt <= '$endDt' ");
            return $sql->row();

        }

        public function f_get_pwShortageData($dist_cd, $cdpo_no)
        {

            $sql = $this->db->query(" SELECT trans_dt, order_no, challan_no, shortage_amnt FROM td_sw_payment
                                    WHERE dist_cd = $dist_cd AND cdpo_no = $cdpo_no ");
            return $sql->result();

        }

        public function f_get_pwShortageTotData($dist_cd, $cdpo_no)
        {

            $sql = $this->db->query(" SELECT SUM(shortage_amnt) AS tot_shortage FROM td_sw_payment
                                    WHERE dist_cd = $dist_cd AND cdpo_no = cdpo_no ");
            return $sql->row();

        }

        public function f_get_dwRevenewRepData($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT a.trans_dt, a.order_no, a.challan_no, a.net_sale_amnt, a.net_purchase_amnt, a.shortage_amnt, a.commission,
                                    b.district_name, c.cdpo FROM td_sw_payment a, md_district b, md_sw_project c WHERE a.dist_cd = b.district_code AND a.cdpo_no = c.sl_no
                                    AND a.trans_dt >= '$startDt' AND a.trans_dt <= '$endDt' ");
            return $sql->result();

        }

        public function f_get_dwTotRevenewData($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(net_sale_amnt) AS sale_amnt, SUM(net_purchase_amnt) AS purchase_amnt, SUM(shortage_amnt) AS shortage, SUM(commission) AS commission
                                    FROM td_sw_payment WHERE trans_dt >= '$startDt' AND trans_dt <= '$endDt' ");
            return $sql->result();

        }

        public function f_get_pwRevenewData($dist_cd, $cdpo_no)
        {

            $sql = $this->db->query(" SELECT a.trans_dt, a.order_no, a.challan_no, a.net_sale_amnt, a.net_purchase_amnt, a.shortage_amnt, a.commission,
                                    b.district_name, c.cdpo FROM td_sw_payment a, md_district b, md_sw_project c WHERE a.dist_cd = b.district_code AND a.cdpo_no = c.sl_no
                                    AND a.dist_cd = '$dist_cd' AND a.cdpo_no = '$cdpo_no' ");
            return $sql->result();

        }

        public function f_get_pwRevenewTotData($dist_cd, $cdpo_no)
        {

            $sql = $this->db->query(" SELECT SUM(net_sale_amnt) AS sale_amnt, SUM(net_purchase_amnt) AS purchase_amnt, SUM(shortage_amnt) AS shortage, SUM(commission) AS commission
                                    FROM td_sw_payment WHERE dist_cd = '$dist_cd' AND cdpo_no = '$cdpo_no' ");
            return $sql->result();

        }




    }

?>