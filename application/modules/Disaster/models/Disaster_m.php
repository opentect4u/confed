<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

    class Disaster_m extends CI_Model
    {


    // **********************  For DM/ Add Item Tab  ****************************** //

        public function f_get_items()
        {

            $sql = $this->db->query("SELECT * FROM md_dm_item ");
            return $sql->result();

        }

        public function f_get_itemNo()
        {

            $sql = $this->db->query("SELECT MAX(item_no) item_no FROM md_dm_item ");
            return $sql->row();            

        }

        public function entryNewItem($item_no, $item_name, $unit, $created_by, $created_dt)
        {

            $value = array('item_no' => $item_no,
                            'item_name' => $item_name,
                            'unit' => $unit,
                            'created_by' => $created_by,
                            'created_dt' => $created_dt);

            $this->db->insert('md_dm_item',$value);

        }

        public function f_get_itemEdit_data($item_no)
        {

            $sql = $this->db->query(" SELECT * FROM md_dm_item WHERE item_no = $item_no ");
            return $sql->result();

        }

        public function updateItemEntry($item_no, $item_name, $unit, $modified_by, $modified_dt )
        {

            $value = array('item_name' => $item_name,
                            'unit' => $unit,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt);
                            

            $this->db->where('item_no', $item_no); 
            $this->db->update('md_dm_item',$value);            

        }


    // ******************* For DM/ "District Contacts" Section ******************** //

        public function f_get_distContact()
        {

            $sql = $this->db->query(" SELECT * FROM md_dm_dist_contact a, md_district b WHERE a.dist_cd = b.district_code ");
            return $sql->result();

        }

        public function NewDistContact($dist_cd, $oc_name, $oc_phn, $ddmo_name, $ddmo_phn, $sddmo_name, $sddmo_phn, $count_sddmo, $created_by, $created_dt )
        {
            for($i=0; $i<$count_sddmo; $i++)
            {
                $value = array('dist_cd' => $dist_cd,
                                'oc_name' => $oc_name,
                                'oc_phn' => $oc_phn,
                                'ddmo_name' => $ddmo_name,
                                'ddmo_phn' => $ddmo_phn,
                                'sddmo_name' => $sddmo_name[$i],
                                'sddmo_phn' => $sddmo_phn[$i],
                                'created_by' => $created_by, 
                                'created_dt' => $created_dt);

                $this->db->insert('md_dm_dist_contact',$value);   
            }         

        }

        public function f_get_editDistContact($sl_no)
        {

            $sql = $this->db->query(" SELECT * FROM md_dm_dist_contact a, md_district b 
                                    WHERE a.dist_cd = b.district_code AND a.sl_no = $sl_no ");
            return $sql->result();

        }

        public function updateDistContact($sl_no, $dist_cd, $oc_name, $oc_phn, $ddmo_name, $ddmo_phn, $sddmo_name, $sddmo_phn, $modified_by, $modified_dt )
        {

            $value = array('dist_cd' => $dist_cd,
                            'oc_name' => $oc_name,
                            'oc_phn' => $oc_phn,
                            'ddmo_name' => $ddmo_name,
                            'ddmo_phn' => $ddmo_phn,
                            'sddmo_name' => $sddmo_name,
                            'sddmo_phn' => $sddmo_phn,
                            'modified_by' => $modified_by, 
                            'modified_dt' => $modified_dt);

            $this->db->where('sl_no', $sl_no); 
            $this->db->update('md_dm_dist_contact',$value);

        }

    // ************************ For "DM/ SDO Master" ****************************** //
        public function f_get_sdoTableDtls()
        {

            $sql = $this->db->query(" SELECT * FROM md_dm_sdo ORDER BY dist_cd ");
            return $sql->result();

        }

        public function f_get_sdo_tableSlNo()
        {

            $sql = $this->db->query(" SELECT MAX(sl_no) as sl_no FROM md_dm_sdo ");
            return $sql->row();

        }


        public function addSdo($sl_no, $dist_cd, $sdo_name, $qty,$created_by, $created_dt, $row)
        {

            for($i=0; $i<$row; $i++)
            {
                $value = array('sl_no' => $sl_no+$i,
                                'dist_cd' => $dist_cd,
                                'sdo_name' => $sdo_name[$i],
                                'qty'      => $qty[$i],
                                'created_by' => $created_by,
                                'created_dt' => $created_dt );

                $this->db->insert('md_dm_sdo', $value);
            }

        }


        public function f_get_sdo_editData($sl_no, $dist_cd)
        {

            $sql = $this->db->query(" SELECT * FROM md_dm_sdo WHERE sl_no = $sl_no AND dist_cd = '$dist_cd' ");
            return $sql->result();

        }

        public function editSdo($sl_no, $dist_cd, $prev_dist_cd, $sdo_name,$qty, $modified_by, $modified_dt)
        {

            $value = array('dist_cd' => $dist_cd,
                            'sdo_name' => $sdo_name,
                            'qty'      => $qty,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt );
            
            $this->db->where('sl_no', $sl_no);
            $this->db->where('dist_cd', $prev_dist_cd);
            $this->db->update('md_dm_sdo', $value);

        }

        public function f_delete_sdoEntry($sl_no, $dist_cd)
        {

            $sql = $this->db->query(" DELETE FROM md_dm_sdo WHERE sl_no = $sl_no AND dist_cd = $dist_cd ");

        }

    // ******************* For DM/ "Block" **************************************** //
    public function f_get_bdoDtls()
    {

        $sql = $this->db->query(" SELECT * FROM md_dm_bdo ");
        return $sql->result();

    } 

    public function js_get_sdo_forDist($dist_cd)
    {

        $sql = $this->db->query(" SELECT DISTINCT sl_no, sdo_name FROM md_dm_sdo WHERE dist_cd = $dist_cd ");
        return $sql->result();

    }

    public function js_get_bdo_forSdo($sdo_cd, $dist_cd)
    {

        $sql = $this->db->query(" SELECT sl_no, bdo_name,qty FROM md_dm_bdo WHERE dist_cd= $dist_cd AND sdo_cd = $sdo_cd ");
        return $sql->result();

    }

    public function f_get_maxSlNo_forBdoTable()
    {

        $sql = $this->db->query(" SELECT MAX(sl_no) AS sl_no FROM md_dm_bdo ");
        return $sql->row();

    }

    public function insert_newBdo($sl_no, $dist_cd, $sdo_cd, $bdo_name,$qty, $row, $created_by, $created_dt)
    {

        for($i=0; $i<$row; $i++)
        {

            $value = array('sl_no' => $sl_no+$i,
                            'dist_cd' => $dist_cd,
                            'sdo_cd' => $sdo_cd,
                            'bdo_name' => $bdo_name[$i],
                            'qty' => $qty[$i],
                            'created_by' => $created_by,
                            'created_dt' => $created_dt );

            $this->db->insert('md_dm_bdo', $value);

        }

    }


    public function f_get_bdo_editDtls($sl_no, $dist_cd, $sdo_cd)
    {

        $sql = $this->db->query(" SELECT a.sl_no, a.dist_cd, a.sdo_cd, a.bdo_name, a.qty,b.district_name, c.sdo_name FROM 
                                md_dm_bdo a, md_district b, md_dm_sdo c WHERE 
                                a.dist_cd = b.district_code AND
                                a.sdo_cd = c.sl_no AND  
                                a.sl_no = $sl_no AND a.dist_cd = $dist_cd AND a.sdo_cd = $sdo_cd ");
        return $sql->result();

    }

    public function f_update_bdoEntry($sl_no, $prev_dist_cd, $prev_sdo_cd, $dist_cd, $sdo_cd, $bdo_name,$qty, $modified_by, $modified_dt)
    {

        $value = array('dist_cd'     => $dist_cd,
                        'sdo_cd'     => $sdo_cd,
                        'bdo_name'   => $bdo_name,
                        'qty'        => $qty,
                        'modified_by'=> $modified_by,
                        'modified_dt'=>$modified_dt );

        $this->db->where('sl_no', $sl_no);
        $this->db->where('dist_cd', $prev_dist_cd);
        $this->db->where('sdo_cd', $prev_sdo_cd);
        $this->db->update('md_dm_bdo', $value);

    }

    public function f_delete_bdoEntry($sl_no, $dist_cd, $sdo_cd)
    {

        $sql = $this->db->query(" DELETE FROM md_dm_bdo WHERE sl_no = $sl_no AND dist_cd = $dist_cd AND sdo_cd = $sdo_cd ");

    }



    // ******************  For DM/ "Distribution Points" Tab  *********************//

        public function f_get_distPoints()
        {

            // $sql = $this->db->query("SELECT DISTINCT a.sl_no, b.bdo_name 
            //                         FROM md_dist_point a , md_dm_bdo b 
            //                         WHERE a.dist_cd = b.dist_cd
            //                      AND a.sdo = b.sdo_cd
            //                         AND a.bdo = b.sl_no ");

$sql = $this->db->query("SELECT DISTINCT a.sl_no, b.bdo_name,c.sdo_name sdo_name,a.agent
                        FROM md_dist_point a , md_dm_bdo b ,md_dm_sdo c
                        WHERE a.dist_cd = b.dist_cd 
                        AND   b.dist_cd = c.dist_cd
                        and a.sdo =c.sl_no
                        and a.bdo = b.sl_no");
                                    echo $this->db->last_query();
            return $sql->result();
            
        }

        public function f_get_pointNo()
        {

            $sql = $this->db->query("SELECT MAX(point_no) point_no FROM md_dist_point ");
            return $sql->row();

        }


        public function f_get_max_distPoint_slNo()
        {

            $sql = $this->db->query(" SELECT MAX(sl_no) AS sl_no FROM md_dist_point ");
            return $sql->row();

        }

        public function f_get_districtCode() // also using for ** DM/Work Order **/ ** DM/Transaction/Distribution tab also ---
        // ** DM/Report/Agent Distribution Tab // ** Agent Delivery Tab --> 
        {

            $sql = $this->db->query("SELECT * FROM md_district ORDER BY district_name ");
            return $sql->result();

        }



        public function entryNewPoint($sl_no, $point_no, $dist_cd, $sdo, $bdo, $agent, $agent_phn, $agent_adr, $row, $created_by, $created_dt)
        {

            for($i=0; $i<$row; $i++)
            {
                $value = array( 'sl_no' => $sl_no,
                                'point_no' => $point_no+$i,
                                'dist_cd' => $dist_cd,
                                'sdo' => $sdo,
                                'bdo' => $bdo,
                                'agent' => $agent[$i],
                                'agent_phn' => $agent_phn[$i],
                                'agent_adr' => $agent_adr[$i],
                                'created_by' => $created_by,
                                'created_dt' => $created_dt);

                $this->db->insert('md_dist_point',$value);
            //    echo $this->db->last_query();
            //    die();
            }

        }

        public function f_get_distPointDtls($sl_no)
        {
             
            $sql = $this->db->query("SELECT DISTINCT a.sl_no, a.dist_cd, a.sdo, a.bdo, b.district_name, c.sdo_name, d.bdo_name
                                    FROM md_dist_point a , md_district b, md_dm_sdo c, md_dm_bdo d
                                    WHERE a.dist_cd = b.district_code 
                                    AND a.sdo = c.sl_no
                                    AND a.bdo = d.sl_no
                                    and a.dist_cd=c.dist_cd
                                    and a.dist_cd=d.dist_cd
                                    AND a.sl_no = $sl_no ");
            return $sql->result();

        }

        public function f_get_distPoint_agentDtls($sl_no)
        {

            $sql = $this->db->query(" SELECT point_no, agent, agent_phn, agent_adr FROM md_dist_point WHERE sl_no = $sl_no ");
            return $sql->result();
;
        }


        public function f_delete_agent($sl_no)
        {

            $sql = $this->db->query(" DELETE FROM md_dist_point WHERE sl_no = $sl_no ");

        }

        public function updateAgentEtntry($sl_no, $point_no, $dist_cd, $sdo, $bdo, $agent, $agent_phn, $agent_adr, $modified_by, $modified_dt, $row )
        {

            for($i=0; $i<$row; $i++)
            {
                $value = array('sl_no' => $sl_no,
                                'point_no' => $point_no[$i],
                                'dist_cd' => $dist_cd,
                                'sdo' => $sdo,
                                'bdo' => $bdo,
                                'agent' => $agent[$i],
                                'agent_phn' => $agent_phn[$i],
                                'agent_adr' => $agent_adr[$i],
                                'modified_by' => $modified_by,
                                'modified_dt' => $modified_dt);

                $this->db->insert('md_dist_point',$value);     
            }                        

        }



    // ******************  For DM/ "Work Order" Tab  *********************//


        public function f_get_workOrder()
        {

            $sql = $this->db->query("SELECT DISTINCT a.dist_cd, a.order_no, a.order_dt, b.district_name FROM td_dm_work_order a , md_district b
                                    WHERE a.dist_cd = b.district_code ORDER BY order_dt ");
            return $sql->result();

        }
        
        //// "f_get_districtCode()" is being taken from DM/Distribution Point section ---> 

        public function f_get_item()
        {

            $sql = $this->db->query("SELECT * FROM md_dm_item ");
            return $sql->result();

        }

        public function f_get_max_slNo()
        {

            $sql = $this->db->query("SELECT MAX(sl_no) sl_no FROM td_dm_work_order ");
            return $sql->row();

        }

        public function f_js_get_itemUnit($item_no)
        {

            $sql = $this->db->query(" SELECT unit FROM md_dm_item WHERE item_no = $item_no ");
            return $sql->row();

        }

        public function entryNewOrder( $sl_no, $order_no, $order_dt, $dist_cd, $item, $allot_qty, $created_by, $created_dt, $row )
        {

            for($i= 0; $i<$row; $i++)
            {
                $value = array(
                    'sl_no'         =>  $sl_no+$i,
                    'order_no'      =>  $order_no,
                    'order_dt'      =>  $order_dt,
                    'dist_cd'       =>  $dist_cd[$i],
                    'item'          =>  $item[$i],
                    'allot_qty'     =>  $allot_qty[$i],
                    //'allot_qty_qnt' =>  $allot_qty_qnt,
                    'created_by'    =>  $created_by,
                    'created_dt'    =>  $created_dt);

                $this->db->insert('td_dm_work_order',$value);    
            }

        }

        public function f_get_check_orderAllocation($dist_cd, $order_no)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS num_row FROM td_dm_distribution WHERE dist_cd = $dist_cd AND order_no = '$order_no' ");
            return $sql->row();

        }

        public function f_get_workOrderDtls($dist_cd, $order_no)
        {
            
            // $sql = $this->db->query("SELECT order_no FROM td_dm_work_order WHERE order_no= '$order_no' AND dist_cd = $dist_cd AND sl_no = $sl_no ");
            // $order_no = $sql->row();

            //echo($order_no->order_no); die;
            //$order_no = $order_no->order_no;

            $sql1 = $this->db->query("SELECT DISTINCT a.dist_cd, a.order_no, a.order_dt, b.district_name FROM td_dm_work_order a , md_district b
                                    WHERE a.dist_cd = b.district_code 
                                    AND a.dist_cd = $dist_cd AND a.order_no = '$order_no' ");
                                    
            return $sql1->result();

        }

        public function f_get_workOrder_itemDtls($dist_cd, $order_no)
        {

            $sql = $this->db->query(" SELECT a.item, a.allot_qty, b.item_name, b.unit FROM td_dm_work_order a, md_dm_item b
                                    WHERE a.item = b.item_no AND a.dist_cd = $dist_cd AND a.order_no = '$order_no' ");
            return $sql->result();

        }

        public function updateWorkOrder( $sl_no, $order_no, $order_dt, $dist_cd, $item, $allot_qty, $allot_qty_qnt, $modified_by, $modified_dt )
        {

            $value = array( 'order_dt'      =>  $order_dt,
                            'allot_qty'     =>  $allot_qty,
                            'allot_qty_qnt' =>  $allot_qty_qnt,
                            'modified_by'    =>  $modified_by,
                            'modified_dt'    =>  $modified_dt);
          
            $this->db->where('order_no', $order_no); 
            $this->db->where('dist_cd', $dist_cd); 
            $this->db->where('item', $item);
            $this->db->where('sl_no', $sl_no); 

            $this->db->update('td_dm_work_order',$value);     

        }


        public function deleteWorkOrder($dist_cd, $order_no)
        {

            $sql = $this->db->query(" DELETE FROM td_dm_work_order WHERE dist_cd = $dist_cd AND order_no = '$order_no' ");
            
        }

        ///////////////////////////////////////////////////////////////////////////////////////

        // ********************** For DM/Report/Work Order tab ****************************//
                                ## controller = Report.php ## 
        ///////////////////////////////////////////////////////////////////////////////////////


        public function f_get_woDtls()
        {

            $sql = $this->db->query("SELECT DISTINCT order_no, order_dt  FROM td_dm_work_order ");
            return $sql->result();

        } 


        public function f_get_reportDtls($order_no)
        {

            $sql = $this->db->query("SELECT * FROM td_dm_work_order a, md_dm_item b, md_district c 
                                    WHERE a.item = b.item_no AND a.dist_cd = c.district_code
                                    AND a.order_no = '$order_no' ORDER BY district_name ");
            return $sql->result(); 

        } 

        public function f_get_orderDt($order_no)
        {

            $sql = $this->db->query(" SELECT DISTINCT order_dt FROM td_dm_work_order WHERE order_no = '$order_no' ");
            return $sql->row();

        }

        public function f_get_item_no($order_no)
        {

            $sql = $this->db->query(" SELECT DISTINCT item  FROM td_dm_work_order WHERE order_no = '$order_no' ");
            return $sql->row();

        }

        public function f_get_itemName($item_no)
        {

            $sql = $this->db->query(" SELECT DISTINCT item_name, unit  FROM md_dm_item WHERE item_no = $item_no ");
            return $sql->result();

        }

        public function f_get_totalAllotQty($order_no)
        {

            $sql = $this->db->query("SELECT SUM(allot_qty) allot_qty FROM td_dm_work_order WHERE 
                                    order_no = '$order_no' ");

            return $sql->row();

        }


        ///////////////////////////////////////////////////////////////////////////////////////

        // ********************** For DM/Transaction/ Distribution tab ****************************//
                                ## controller = DIsaster.php ## 
        ///////////////////////////////////////////////////////////////////////////////////////

        public function f_get_agentDistributionDtls()
        {

            // $sql = $this->db->query(" SELECT * FROM td_dm_distribution a, md_district b, md_dist_point c 
            //                         WHERE a.dist_cd = b.district_code AND a.point_no = c.point_no ");

            
           /* $sql = $this->db->query(" SELECT a.sl_no, a.dist_cd, a.order_no, b.district_name, a.sdo_memo, a.bdo_memo
                                    FROM td_dm_distribution a, md_district b
                                    WHERE  a.dist_cd = b.district_code GROUP BY a.sl_no ");*/
                                    $sql = $this->db->query(" SELECT a.sl_no, a.dist_cd, a.order_no, b.district_name, a.sdo_memo, a.bdo_memo
                                    FROM td_dm_distribution a, md_district b
                                    WHERE  a.dist_cd = b.district_code order BY a.sl_no ");
            // print_r($sql);
            // die();
            return $sql->result();

        }

        public function f_get_dist_WoNo()
        {

            $sql = $this->db->query(" SELECT DISTINCT a.order_no, b.order_dt FROM td_dm_distribution a,
                                    td_dm_work_order b WHERE a.order_no = b.order_no AND a.dist_cd = b.dist_cd ");  

            return $sql->result();

        }

        public function f_get_dist_orderDt($order_no)
        {

            $sql = $this->db->query(" SELECT order_dt FROM td_dm_work_order WHERE order_no = '$order_no' ");
            return $sql->row();

        }


        public function f_get_agentDistribution_WOdt()
        {

            $sql = $this->db->query(" SELECT DISTINCT a.order_dt AS order_dt FROM td_dm_work_order a, td_dm_distribution b
                                    WHERE a.order_no = b.order_no ");
            return $sql->row();

        }

        public function f_get_orderNo_perDist($dist_cd) // For Jquery
        {

            $sql = $this->db->query(" SELECT DISTINCT order_no AS order_no, order_dt FROM td_dm_work_order WHERE dist_cd = $dist_cd ");
            return $sql->result();
            
        }


        public function f_get_agentDist_agentDtls($dist_cd) // For Jquery 
        {

            $sql = $this->db->query(" SELECT a.point_no, a.agent, b.bdo_name FROM md_dist_point a, md_dm_bdo b
                                    WHERE a.dist_cd = b.dist_cd
                                    AND a.sdo = b.sdo_cd
                                    AND a.bdo = b.sl_no
                                    AND a.dist_cd = $dist_cd
                                    ORDER BY a.agent");
            return $sql->result();

        }


        public function f_getMemo_perDist_perWO($order_no, $dist_cd) // For Jquery
        {

            $sql = $this->db->query(" SELECT DISTINCT sdo_memo FROM td_dm_distribution WHERE dist_cd = $dist_cd AND order_no = '$order_no' ");
            return $sql->result();            

        }

        public function js_get_sdoMemo_perDist_WO_sdo($order_no, $dist_cd, $sdo_memo) // For Jquery
        {

            $sql = $this->db->query(" SELECT DISTINCT bdo_memo FROM td_dm_distribution WHERE dist_cd = $dist_cd
                                    AND order_no = '$order_no' AND sdo_memo = '$sdo_memo' ");
            return $sql->result();                      

        }

        public function f_get_agentDist_maxSlNo()
        {

            $sql = $this->db->query("SELECT MAX(sl_no) sl_no FROM td_dm_distribution ");
            return $sql->row();

        }

        public function f_get_dist_allotQty($order_no, $dist_cd) // For Jquery
        {

            $sql = $this->db->query("SELECT allot_qty FROM td_dm_work_order  WHERE order_no = '$order_no' AND dist_cd = $dist_cd ");
            return $sql->result();

        }


        public function js_duplicatePoint($order_no, $dist_cd, $point_no)
        {

            $sql = $this->db->query(" SELECT * FROM td_dm_distribution WHERE order_no = $order_no, dist_cd = $dist_cd, point_no = $point_no ");
            return $sql->result();

        }


        public function f_get_sdoCd_byDistPoint($dist_cd, $point_no)
        {

            $sql = $this->db->query(" SELECT sdo FROM md_dist_point WHERE dist_cd = $dist_cd AND point_no = $point_no ");
            return $sql->row();

        }

        public function f_get_bdoCd_byDistPoint($dist_cd, $point_no)
        {

            $sql = $this->db->query(" SELECT bdo FROM md_dist_point WHERE dist_cd = $dist_cd AND point_no = $point_no ");
            return $sql->row();

        }

        public function entryAgentDistribution( $sl_no, $dist_dt, $dist_cd, $order_no, $point_no, $allot_qty, $sdo_memo, $bdo_memo, $count_point, $created_by, $created_dt )
        {

            for($i=0; $i<$count_point; $i++)
            {

                $sdoCD = $this->Disaster_m->f_get_sdoCd_byDistPoint($dist_cd, $point_no[$i]);
                $sdo_cd = $sdoCD->sdo;

                $bdoCD = $this->Disaster_m->f_get_bdoCd_byDistPoint($dist_cd, $point_no[$i]);
                $bdo_cd = $bdoCD->bdo;

                $value = array('sl_no' => $sl_no,
                                'dist_dt' => $dist_dt,
                                'dist_cd' => $dist_cd,
                                'sdo_cd' => $sdo_cd,
                                'bdo_cd' => $bdo_cd,
                                'order_no' => $order_no,
                                'point_no' => $point_no[$i],
                                'allot_qty' => $allot_qty[$i],
                                'sdo_memo'  =>  $sdo_memo,
                                'bdo_memo'  =>  $bdo_memo,
                                'created_by' => $created_by,
                                'created_dt' => $created_dt);

                $this->db->insert('td_dm_distribution',$value);

            }

        }

        public function f_get_agentDist_editData($order_no, $sl_no)
        {

            // $sql = $this->db->query(" SELECT * FROM td_dm_distribution a, md_district b, md_dist_point c, md_dm_bdo d
            //                         WHERE a.dist_cd = b.district_code 
            //                         AND c.dist_cd = d.dist_cd
            //                         AND c.sdo = d.sdo_cd
            //                         AND c.bdo = d.sl_no
            //                         AND a.order_no = '$order_no' AND a.point_no = c.point_no 
            //                         AND a.point_no = $point_no AND a.sl_no = $sl_no ");

            $sql = $this->db->query(" SELECT DISTINCT a.sl_no, a.dist_dt, a.sdo_memo, a.bdo_memo, b.district_name, b.district_code, c.order_no, c.order_dt
                                    FROM td_dm_distribution a, md_district b, td_dm_work_order c 
                                    WHERE a.dist_cd = b.district_code 
                                    AND a.order_no = c.order_no 
                                    AND a.dist_cd = c.dist_cd
                                    AND a.sl_no = $sl_no
                                    AND a.order_no = '$order_no' ");
                                    
            return $sql->result();            

        }

        public function f_get_agentDist_edit_tableDtls($order_no, $dist_cd, $sl_no)
        {

            $sql = $this->db->query(" SELECT a.point_no, a.allot_qty, b.agent 
                                    FROM td_dm_distribution a, md_dist_point b
                                    WHERE a.dist_cd = b.dist_cd 
                                    AND a.sdo_cd = b.sdo 
                                    AND a.bdo_cd = b.bdo
                                    AND a.order_no = '$order_no'
                                    AND a.dist_cd = $dist_cd
                                    AND a.sl_no = $sl_no
                                    ");

            return $sql->result();

        }

        public function f_get_agentDist_edit_WOdt_data($order_no)
        {

            $sql = $this->db->query(" SELECT DISTINCT a.order_dt AS order_dt FROM td_dm_work_order a, td_dm_distribution b
                                    WHERE a.order_no = b.order_no AND b.order_no = '$order_no' ");
            return $sql->row();

        }

        public function f_get_editDistCode($sl_no, $point_no)
        {

            $sql = $this->db->query("SELECT dist_cd FROM td_dm_distribution WHERE sl_no = $sl_no AND point_no = $point_no");
            return $sql->row();

        }

        public function f_get_totQty($dist_cd, $order_no)
        {

            $sql = $this->db->query("SELECT allot_qty FROM td_dm_work_order WHERE order_no = '$order_no' AND dist_cd = $dist_cd ");
            return $sql->result();

        }

        public function f_get_agentDist_edit_totQty($order_no, $dist_cd, $sl_no)
        {

            $sql = $this->db->query(" SELECT SUM(allot_qty) AS total FROM td_dm_distribution 
                                    WHERE order_no = '$order_no'
                                    AND dist_cd = $dist_cd
                                    AND sl_no = $sl_no ");

            return $sql->row();

        }

        public function updateAgentDistribution($sl_no, $dist_dt, $dist_cd, $order_no, $sdo_memo, $bdo_memo, $point_no, $allot_qty, $row, $modified_by, $modified_dt)
        {
            for($i=0; $i< $row; $i++)
            {
                
                $sdoCD = $this->Disaster_m->f_get_sdoCd_byDistPoint($dist_cd, $point_no[$i]);
                $sdo_cd = $sdoCD->sdo;

                $bdoCD = $this->Disaster_m->f_get_bdoCd_byDistPoint($dist_cd, $point_no[$i]);
                $bdo_cd = $bdoCD->bdo;

                $value = array('sl_no' => $sl_no,
                                'dist_dt' => $dist_dt,
                                'dist_cd' => $dist_cd,
                                'sdo_cd' => $sdo_cd,
                                'bdo_cd' => $bdo_cd,
                                'order_no' => $order_no,
                                'point_no' => $point_no[$i],
                                'allot_qty' => $allot_qty[$i],
                                'sdo_memo'  =>  $sdo_memo,
                                'bdo_memo'  =>  $bdo_memo,
                                'modified_by' => $modified_by,
                                'modified_dt' => $modified_dt);

                $this->db->insert('td_dm_distribution',$value);
            
            }

        }

        public function f_delete_agent_distribution($sl_no, $dist_cd, $order_no)
        {

            $sql = $this->db->query(" DELETE FROM td_dm_distribution WHERE sl_no = $sl_no AND dist_cd = $dist_cd AND order_no = '$order_no' ");

        }

        public function f_get_distribution_memoNo($order_no, $dist_cd, $sl_no)
        {

            $sql = $this->db->query(" SELECT DISTINCT sdo_memo, bdo_memo FROM td_dm_distribution WHERE sl_no = $sl_no AND dist_cd = $dist_cd AND order_no = '$order_no' ");
            return $sql->result();

        }

        public function f_check_distribution_memoNos($order_no, $dist_cd, $sdo_memo, $bdo_memo)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS num_row FROM td_dm_delivery 
                                    WHERE order_no = '$order_no' 
                                    AND dist_cd = $dist_cd
                                    AND sdo_memo = '$sdo_memo'
                                    AND bdo_memo = '$bdo_memo' ");
            return $sql->row();

        }

        ////////////////////////////////////////////////////////////////////////////////

        // *********************** For DM/ Report/ Distribution Tab ******************//
                                    # controller: Report.php
        ////////////////////////////////////////////////////////////////////////////////

        public function f_get_distName($dist_cd)
        {

            $sql = $this->db->query("SELECT district_name FROM md_district WHERE district_code = $dist_cd ");
            return $sql->row();

        }

        public function f_get_totDistAllot_Qty($dist_cd, $order_no)
        {

            $sql = $this->db->query("SELECT allot_qty FROM td_dm_distribution WHERE dist_cd = $dist_cd AND order_no = '$order_no' ");
            return $sql->row();

        }

        public function f_get_agentDistReport_data($dist_cd, $order_no)
        {

            $sql = $this->db->query(" SELECT * FROM td_dm_distribution a, md_dist_point b WHERE a.dist_cd = b.dist_cd
                                    AND a.point_no = b.point_no AND a.dist_cd = $dist_cd AND a.order_no = '$order_no' ");

            return $sql->result();

        }

        public function f_get_tot_agentDistQty($order_no, $dist_cd)
        {

            $sql = $this->db->query(" SELECT SUM(allot_qty) tot_distQty FROM td_dm_distribution WHERE
                                    order_no = '$order_no' AND dist_cd = $dist_cd ");

            return $sql->row();

        }

    // ******************  For DM/ Transaction / Agent Delivery Tab  *********************//


        public function f_get_agentDeliveryDtls()
        {

            // $sql = $this->db->query(" SELECT a.sl_no, a.del_dt, a.trans_id, a.order_no, c.order_dt,  a.sdo_memo, a.bdo_memo, a.dist_cd, d.district_name, 
            // a.point_no, e.agent, a.bill_no, GROUP_CONCAT(DISTINCT b.challan_no) AS challan_no , a.tot_qty   

            // FROM td_dm_delivery a, td_dm_delivery_details b, td_dm_work_order c, md_district d, md_dist_point e
            
            // WHERE a.del_dt = b.del_dt
            // AND a.trans_id = b.trans_id
            // AND a.bill_no = b.bill_no
            // AND a.order_no = c.order_no
            // AND a.dist_cd = d.district_code
            // AND a.point_no = e.point_no
            
            // GROUP BY a.bill_no, a.del_dt, a.trans_id, a.order_no, a.sdo_memo, a.bdo_memo, a.dist_cd, a.point_no, a.tot_qty, c.order_dt, 
            // d.district_name, e.agent, a.sl_no   ORDER BY a.del_dt ");

            $sql = $this->db->query(" SELECT a.sl_no, a.trans_id, a.trans_dt, a.bill_dt, a.order_no, a.sdo_memo, a.bdo_memo, a.dist_cd, a.point_no, 
                                    a.bill_no, a.tot_qty, b.district_name, c.agent, d.order_dt
                                    FROM td_dm_delivery a, md_district b, md_dist_point c, td_dm_work_order d
                                    WHERE a.dist_cd = b.district_code
                                    AND a.point_no = c.point_no 
                                    AND a.dist_cd = c.dist_cd
                                    AND a.dist_cd = d.dist_cd
                                    AND a.order_no = d.order_no ");
            
            return $sql->result();

        }

        public function f_get_vendor_forDelivery()
        {

            $sql = $this->db->query(" SELECT sl_no, vendor_name FROM md_sw_vendor ");
            return $sql->result();

        }

        public function f_get_deliverySlNo()
        {

            $sql = $this->db->query(" SELECT MAX(sl_no) sl_no FROM td_dm_delivery ");
            return $sql->row();

        }

        public function f_get_agentDeliveryDtls_orderDt()
        {

            $sql = $this->db->query(" SELECT DISTINCT b.order_dt FROM td_dm_delivery a, td_dm_work_order b 
                                    WHERE a.order_no = b.order_no ");
            return $sql->row();                 

        }

        public function js_get_deliveryTransId($del_dt)
        {

            $sql = $this->db->query(" SELECT MAX(trans_id) trans_id FROM td_dm_delivery WHERE del_dt = '$del_dt' ");
            return $sql->row();

        }


        public function js_agent_allotAmount($order_no, $dist_cd, $point_no, $sdo_memo) // For JS 
        {

            $sql = $this->db->query(" SELECT SUM(allot_qty) allot_qty FROM td_dm_distribution WHERE 
                                    dist_cd = $dist_cd AND point_no = $point_no AND order_no = '$order_no'
                                    AND sdo_memo = '$sdo_memo' ");
            return $sql->row();

        }

        public function js_agent_delQty($order_no, $dist_cd, $point_no, $sdo_memo)
        {

            $sql = $this->db->query(" SELECT SUM(tot_qty) tot_qty FROM td_dm_delivery WHERE 
                                    order_no = '$order_no' AND dist_cd = $dist_cd AND point_no = $point_no
                                    AND sdo_memo = '$sdo_memo' ");
            return $sql->row();

        }

        public function f_get_maxTransId_deliveryTable($transDt)
        {

            $sql = $this->db->query(" SELECT MAX(trans_id) as trans_id FROM td_dm_delivery WHERE DATE_FORMAT(created_dt, '%Y-%m-%d') = '$transDt' ");
            
            return $sql->row();

        }

        public function js_get_prev_deliveryDtls($distCd, $pointNo, $orderNo, $sdoMemo)
        {

            $sql = $this->db->query(" SELECT bill_no, bill_dt, tot_qty FROM td_dm_delivery WHERE order_no = '$orderNo' 
                                    AND point_no = $pointNo AND dist_cd = $distCd AND sdo_memo = '$sdoMemo' ORDER BY trans_dt ");
            return $sql->result();

        }
    
        public function insertAgentDelivery($sl_no, $trans_id, $trans_dt, $bill_dt, $dist_cd, $order_no, $point_no, $sdo_memo, $bdo_memo, $bill_no, $tot_qty, $vendor, $challan_from, $challan_to, $rate, $amount, $remarks, $created_by, $created_dt )
        {

            //echo $challan_count; die;

            $value1 = array('sl_no' => $sl_no,
                            'trans_id' => $trans_id,
                            'trans_dt' => $trans_dt,
                            'bill_dt' => $bill_dt,
                            'dist_cd' => $dist_cd,
                            'order_no' => $order_no,
                            'point_no' => $point_no,
                            'sdo_memo' => $sdo_memo,
                            'bdo_memo' => $bdo_memo,
                            'bill_no' => $bill_no, 
                            'challan_from' => $challan_from,
                            'challan_to' => $challan_to,
                            'tot_qty' => $tot_qty,
                            'vendor' => $vendor,
                            'rate' => $rate,
                            'amount' => $amount,
                            'remarks' => $remarks,
                            'created_by' => $created_by,
                            'created_dt' => $created_dt);
                                
            $this->db->insert('td_dm_delivery',$value1);

            //echo $challan_count; die;

            // for($i= 0; $i< $challan_count; $i++)
            // {
                
            //     $value2 = array( 'trans_id' => $trans_id,
            //                     'del_dt' => $del_dt,
            //                     'bill_no' => $bill_no,
            //                     'challan_no' => $challan_no[$i],
            //                     'truck' => $truck[$i],
            //                     'qty' => $qty[$i],
            //                     'created_by' => $created_by,
            //                     'created_dt' => $created_dt );

            //     $this->db->insert('td_dm_delivery_details',$value2);

            // }

        }

        public function get_delivery_memoNo($sl_no)
        {

            $sql = $this->db->query(" SELECT sdo_memo FROM td_dm_delivery WHERE sl_no = $sl_no ");
            return $sql->row();

        }

        public function get_deliveryEdit_dtls($sl_no, $trans_id, $trans_dt)
        {

            $sql = $this->db->query(" SELECT a.sl_no, a.trans_id, a.trans_dt, a.order_no, a.sdo_memo, a.bdo_memo, b.district_code, b.district_name, a.point_no,
                                    c.agent, e.sdo_name, a.bill_no, a.bill_dt, a.challan_from, a.challan_to, a.tot_qty, a.vendor, a.rate, a.amount, a.remarks, d.vendor_name  
                                    FROM td_dm_delivery a, md_district b, md_dist_point c, md_sw_vendor d, md_dm_sdo e
                                    WHERE a.dist_cd = b.district_code
                                    AND a.point_no = c.point_no
                                    AND a.vendor = d.sl_no
                                    AND c.dist_cd = e.dist_cd
                                    AND c.sdo = e.sl_no
                                    AND a.sl_no = $sl_no 
                                    AND a.trans_dt = '$trans_dt' 
                                    AND trans_id = $trans_id ");
                                       
            return $sql->result();

        }

        public function get_deliveryEdit_agentSdoBdoOrder($sl_no, $trans_id, $trans_dt)
        {

            $sql = $this->db->query(" SELECT point_no, sdo_memo, bdo_memo, order_no, dist_cd FROM td_dm_delivery WHERE sl_no = $sl_no AND trans_dt = '$trans_dt' AND trans_id = $trans_id ");
            
            return $sql->result();

        }

        public function get_challanEdit_dtls($bill_dt, $bill_no)
        {

            $sql = $this->db->query(" SELECT challan_no, truck, qty FROM td_dm_delivery_details WHERE bill_dt = '$bill_dt' AND bill_no = '$bill_no' ");

            return $sql->result();

        }

        public function get_deliveryEdit_qtyBal($sl_no, $dist_cd, $order_no, $point_no, $sdo_memo)
        {

            $sql = $this->db->query(" SELECT SUM(tot_qty) totQty FROM td_dm_delivery WHERE sl_no != $sl_no 
                                    AND order_no = '$order_no' AND sdo_memo = '$sdo_memo' AND point_no = $point_no 
                                    AND dist_cd = $dist_cd");
            return $sql->row();

        }

        public function updateAgentDelivery($trans_id, $trans_dt, $dist_cd, $order_no, $point_no, $sdo_memo, $bdo_memo, $bill_no, $bill_dt, $challan_from, $challan_to, $rate, $tot_qty, $vendor, $amount, $remarks, $modified_by, $modified_dt )
        {

            $value1 = array(
                            'dist_cd' => $dist_cd,
                            'order_no' => $order_no,
                            'point_no' => $point_no,
                            'sdo_memo' => $sdo_memo,
                            'bdo_memo' => $bdo_memo,
                            'bill_no' => $bill_no,
                            'bill_dt' => $bill_dt,
                            'challan_from' => $challan_from,
                            'challan_to' => $challan_to,
                            'rate' => $rate,
                            'tot_qty' => $tot_qty,
                            'vendor' => $vendor,
                            'amount' => $amount,
                            'remarks' => $remarks,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt);

            $this->db->where('trans_dt', $trans_dt); 
            $this->db->where('trans_id', $trans_id); 
           
            $this->db->update('td_dm_delivery',$value1);

            // for($i= 0; $i< $challan_count; $i++)
            // {
                
            //     $value2 = array( 'trans_id' => $trans_id,
            //                     'del_dt' => $del_dt,
            //                     'bill_no' => $bill_no,
            //                     'challan_no' => $challan_no[$i],
            //                     'truck' => $truck[$i],
            //                     'qty' => $qty[$i],
            //                     'modified_by' => $modified_by,
            //                     'modified_dt' => $modified_dt );

            //     $this->db->where('trans_id', $trans_id); 
            //     $this->db->where('del_dt', $del_dt); 
            //     $this->db->where('bill_no', $bill_no); 

            //     $this->db->update('td_dm_delivery_details',$value2);

            // }
            

        }


        public function f_delete_deliveryEntry($sl_no, $del_dt, $trans_id)
        {

            $this->db->where('sl_no', $sl_no);
            $this->db->where('trans_dt', $del_dt);
            $this->db->where('trans_id', $trans_id);
            
            $this->db->delete('td_dm_delivery');
            //$this->db->delete('td_dm_delivery_details');

        }

      /* public function f_delete_deliveryDtls($del_dt, $trans_id)
        {

            $this->db->where('del_dt', $del_dt);
            $this->db->where('trans_id', $trans_id);
            
            $this->db->delete('td_dm_delivery_details');

        }*/

    //////////////// ********* DM/ Transaction- Sale ************** //////////////
        public function f_get_agentSaleDtls()
        {

            $sql = $this->db->query(" SELECT a.trans_id, a.trans_dt, a.bill_dt, a.order_no, a.sdo_memo, a.bdo_memo, a.dist_cd, a.point_no, 
                                    a.bill_no, b.district_name, c.agent, d.order_dt
                                    FROM td_dm_sale a, md_district b, md_dist_point c, td_dm_work_order d
                                    WHERE a.dist_cd = b.district_code
                                    AND a.point_no = c.point_no 
                                    AND a.dist_cd = c.dist_cd
                                        AND a.dist_cd = d.dist_cd
                                    AND a.order_no = d.order_no  ");

            return $sql->result();

        }


        public function js_check_pBillNo_forSale($p_bill_no, $p_bill_dt)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS row FROM td_dm_delivery WHERE bill_no = '$p_bill_no' AND bill_dt = '$p_bill_dt' ");
            return $sql->row();

        }

        public function js_get_details_byPBill($p_bill_no, $p_bill_dt)
        {

            $sql = $this->db->query(" SELECT a.sdo_memo, a.bdo_memo, a.point_no, a.challan_from, a.challan_to, a.tot_qty, a.amount, b.agent
                                    FROM td_dm_delivery a, md_dist_point b WHERE a.dist_cd = b.dist_cd AND a.point_no = b.point_no AND
                                    a.bill_no = '$p_bill_no' AND a.bill_dt = '$p_bill_dt' ");
            return $sql->result();

        }

        public function js_check_duplicate_PBillNo($pb_no, $dist_cd, $order_no)
        {

            $sql = $this->db->query(" SELECT COUNT(*) AS num_row FROM td_dm_sale WHERE pb_no = '$pb_no' AND dist_cd = $dist_cd AND order_no = '$order_no' ");
            return $sql->row();

        }

        public function f_get_max_transId_for_saleTable($trans_dt)
        {

            $sql = $this->db->query(" SELECT MAX(trans_id) AS trans_id FROM td_dm_sale WHERE trans_dt = '$trans_dt' ");
            return $sql->row();

        }

        public function saleBillEntry($value)
        {

            $this->db->insert('td_dm_sale', $value);

        }
        
        public function f_get_saleEdit($trans_id, $trans_dt)
        {

            $sql = $this->db->query(" SELECT a.trans_id, a.trans_dt, a.dist_cd, a.order_no, a.pb_no, a.sdo_memo, a.bdo_memo, a.challan_from, a.challan_to, a.bill_no AS sb_no, a.bill_dt AS sb_dt, a.rate, a.amount AS sb_amount, a.remarks, 
                                    b.bill_dt AS pb_dt, b.tot_qty, b.amount AS pb_amount, c.district_name, d.agent
                                    FROM td_dm_sale a, td_dm_delivery b, md_district c, md_dist_point d
                                    WHERE a.dist_cd = b.dist_cd 
                                    AND a.order_no = b.order_no
                                    AND a.sdo_memo = b.sdo_memo 
                                    AND a.bdo_memo = b.bdo_memo 
                                    AND a.challan_from = b.challan_from
                                    AND a.challan_to = b.challan_to 
                                    AND a.pb_no = b.bill_no 
                                    AND a.dist_cd = c.district_code 
                                    AND a.dist_cd = d.dist_cd
                                    AND a.point_no = d.point_no
                                    AND a.trans_id = '$trans_id'
                                    AND a.trans_dt = '$trans_dt' ");

            return $sql->result();

        }

        public function updateAgentSale($value, $trans_dt, $trans_id)
        {

            $this->db->where('trans_id', $trans_id);
            $this->db->where('trans_dt', $trans_dt);
            $this->db->update('td_dm_sale', $value);

        }

        public function f_delete_saleEntry($trans_id, $trans_dt)
        {

            $sql = $this->db->query(" DELETE FROM td_dm_sale WHERE trans_dt = '$trans_dt' AND trans_id = $trans_id ");

        }


    /////////// ************ For DM/Confirmation Tab ***************** /////////////

        public function f_get_confirmation_tableData()
        {

            $sql = $this->db->query(" SELECT a.trans_id, a.trans_dt, a.order_no, a.sdo_memo, a.bdo_memo, a.pb_no, a.bill_no as sb_no, a.bill_dt as sb_dt,
                                    b.order_dt, c.bill_dt as pb_dt FROM td_dm_sale a, td_dm_work_order b, td_dm_delivery c
                                    WHERE a.order_no = b.order_no
                                    AND a.dist_cd = b.dist_cd
                                    AND a.order_no = c.order_no
                                    AND a.sdo_memo = c.sdo_memo
                                    AND a.dist_cd = c.dist_cd
                                    AND a.point_no = c.point_no
                                    AND a.challan_from = c.challan_from
                                    AND a.challan_to = c.challan_to
                                    AND a.pb_no = c.bill_no
                                    AND a.cnf_status = 0 ");
            return $sql->result();

        }
        
        public function f_get_confirmation_entryDtls($trans_id, $trans_dt)
        {

            $sql = $this->db->query(" select a.trans_dt, a.trans_id, a.bill_no, a.sdo_memo, a.bdo_memo, a.challan_from, a.challan_to, a.pb_no, a.dist_cd, a.point_no, a.order_no, b.district_name, c.agent, d.order_dt, e.tot_qty
                                    FROM td_dm_sale a, md_district b, md_dist_point c, td_dm_work_order d, td_dm_delivery e
                                    WHERE a.dist_cd = b.district_code
                                    AND a.point_no = c.point_no 
                                    AND a.dist_cd = c.dist_cd 
                                    AND a.order_no = d.order_no
                                    AND a.dist_cd = d.dist_cd
                                    AND a.order_no = e.order_no
                                    AND a.sdo_memo = e.sdo_memo
                                    AND a.bdo_memo = e.bdo_memo
                                    AND a.dist_cd = e.dist_cd
                                    AND a.point_no = e.point_no
                                    AND a.challan_from = e.challan_from
                                    AND a.challan_to = e.challan_to
                                    AND a.pb_no = e.bill_no
                                    AND a.trans_id = $trans_id
                                    AND a.trans_dt = '$trans_dt' ");

            return $sql->result();

        }

        public function f_confirmationEntry($value, $trans_id, $trans_dt)
        {

            $this->db->where('trans_dt', $trans_dt);
            $this->db->where('trans_id', $trans_id);
            $this->db->update('td_dm_sale', $value);

        }

        public function js_get_unapproved_data($dist_cd)
        {

            $sql = $this->db->Query(" SELECT * FROM td_dm_delivery WHERE dist_cd = $dist_cd AND cnf_status = 0 ");
            return $sql->result();

        }

        public function f_get_unconfirmedDtls($dist_cd)
        {

            $sql = $this->db->Query(" SELECT a.sl_no AS sl_no, a.del_dt AS del_dt, b.district_name AS district_name, c.agent AS agent, a.order_no AS order_no,
                                    a.sdo_memo AS sdo_memo, d.allot_qty AS allot_qty, a.qty AS qty, a.dist_cd AS dist_cd, e.order_dt AS order_dt 
                                    FROM td_dm_delivery a, md_district b, md_dist_point c, td_dm_distribution d, td_dm_work_order e WHERE 
                                    a.dist_cd = b.district_code AND a.point_no = c.point_no AND a.dist_cd = d.dist_cd AND a.point_no = d.point_no
                                    AND a.order_no = d.order_no AND a.order_no = e.order_no  AND a.dist_cd = e.dist_cd AND a.dist_cd = $dist_cd AND a.cnf_status = 0 ORDER BY a.del_dt ");
                                    
            return $sql->result();

        }

        public function f_get_showDeliveryRecord($sl_no)
        {

            $sql = $this->db->query(" SELECT * FROM td_dm_delivery a, md_district b, md_dist_point c WHERE 
                                    a.dist_cd = b.district_code AND a.point_no = c.point_no AND a.sl_no = $sl_no ");
            
            return $sql->result();

        }

        public function f_get_quantityDetails($sl_no)
        {

            $sql = $this->db->query(" SELECT * FROM td_dm_distribution a, td_dm_delivery b
                                    WHERE a.order_no = b.order_no AND a.sdo_memo = b.sdo_memo AND a.dist_cd = b.dist_cd
                                    AND a.point_no = b.point_no AND b.sl_no = $sl_no ");

            return $sql->result();

        }

        public function f_get_deliveryDetails($sl_no)
        {

            $sql = $this->db->query(" SELECT order_no, sdo_memo, point_no FROM td_dm_delivery WHERE sl_no = $sl_no ");

            return $sql->result();

        }

        public function f_get_totDeliveryQty($order_no, $sdo_memo, $point_no)
        {

            $sql = $this->db->query(" SELECT SUM(qty) AS tot_qty FROM td_dm_delivery WHERE order_no = '$order_no' AND
                                    sdo_memo = '$sdo_memo' AND point_no = $point_no ");

            return $sql->row();
        }

        public function approveDelivery($sl_no, $message, $cnf_by, $cnf_dt)
        {

            $value = array('cnf_status' => 1,
                            'message' => $message,
                            'cnf_by' => $cnf_by,
                            'cnf_dt' => $cnf_dt);

            $this->db->where('sl_no', $sl_no); 
            $this->db->update('td_dm_delivery',$value);

        }

        public function f_get_approvalDist_cd($sl_no)
        {

            $sql = $this->db->query(" SELECT dist_cd FROM td_dm_delivery WHERE sl_no = $sl_no ");
            return $sql->row();

        }

        /////////////////////////////////////////////////////////////////////
        // ************* Report/ agent delivery ********************//
        ////////////////////////////////////////////////////////////////////

        public function f_get_agentDel_report_data($dist_cd, $order_no, $sdo_memo)
        {

            $sql = $this->db->query(" SELECT    a.point_no,
                                                c.agent,
                                                a.order_no,
                                                a.sdo_memo,
                                                a.allot_qty, 
                                                sum(b.tot_qty) tot_qty,
                                                (a.allot_qty - sum(b.tot_qty)) due_qty

                                        FROM   td_dm_distribution a, 
                                                td_dm_delivery b,
                                                md_dist_point c 

                                        WHERE  a.order_no = b.order_no 
                                        AND    a.sdo_memo = b.sdo_memo 
                                        AND    a.point_no = b.point_no
                                        AND    a.dist_cd  = c.dist_cd
                                        AND    a.point_no = c.point_no 
                                        AND	   a.dist_cd  = $dist_cd
                                        AND    a.order_no = '$order_no' 
                                        AND    a.sdo_memo = '$sdo_memo'
                                        group by 
                                                a.point_no, 
                                                a.order_no,
                                                a.sdo_memo,
                                                a.allot_qty  ");
                                                                                    
            
            return $sql->result();

        }


        public function f_get_agentDel_totAlloted($dist_cd, $order_no, $sdo_memo)
        {

            $sql = $this->db->query(" SELECT SUM(allot_qty) tot_allot FROM td_dm_distribution 
                                        WHERE dist_cd = $dist_cd AND order_no = '$order_no' 
                                        AND sdo_memo= '$sdo_memo' ");

            return $sql->row();

        }

        public function f_get_agentDel_totDelivered($dist_cd, $order_no, $sdo_memo)
        {

            $sql = $this->db->query(" SELECT SUM(tot_qty) tot_DelQty FROM td_dm_delivery WHERE
                                    dist_cd = $dist_cd AND order_no = '$order_no' AND sdo_memo = '$sdo_memo'  ");
            
            return $sql->row();

        }



        ////////////////////////////////////////////////////////////////////////
        /// ************* Report/ Confirmation Report ************** ////
        ///////////////////////////////////////////////////////////////////////


        public function f_get_itemList()
        {

            $sql = $this->db->query(" SELECT * FROM md_dm_item ");
            return $sql->result();

        }


        public function f_get_deliveryData($dist_cd, $order_no)
        {

            $sql = $this->db->query(" SELECT  a.bill_no,
                                    a.sdo_memo,
                                    a.bill_dt,
                                    ifnull(b.cnf_memo, 0) AS cnf_memo,
                                    SUM(a.tot_qty) AS del_qty,
                                    SUM(ifnull(b.cnf_qty, 0)) AS cnf_qty,
                                    (SUM(a.tot_qty) - SUM(ifnull(b.cnf_qty, 0))) AS due_qty,
                                    SUM(a.amount) AS del_amount,
                                    ifnull(SUM(b.cnf_qty)*b.rate, 0) AS cnf_amount,
                                    b.rate,
                                    b.cnf_dt  
                                    
                                    FROM td_dm_delivery a LEFT JOIN td_dm_confirmation b
                                    ON a.bill_no = b.bill_no
                                    
                                    WHERE a.dist_cd = $dist_cd
                                    AND a.order_no = '$order_no'
                                    
                                    GROUP BY a.bill_no,
                                            a.bill_dt, 
                                            b.rate,
                                            b.cnf_memo,
                                            a.sdo_memo,
                                            b.cnf_dt ");
                        
            return $sql->result();

        }


        public function f_get_cnfReport_totalData($dist_cd, $order_no)
        {

            $sql = $this->db->query(" SELECT SUM(del_qty) AS delQty_tot, 
                                    SUM(cnf_qty) AS cnfQty_tot, SUM(due_qty) AS dueQty_tot, 
                                    SUM(del_amount) AS delAmnt_tot, SUM(cnf_amount) AS cnfAmnt_tot		FROM 			
                                                            
                                        (SELECT  a.bill_no,
                                        ifnull(b.cnf_memo, 0),
                                        SUM(a.tot_qty) AS del_qty,
                                        SUM(ifnull(b.cnf_qty, 0)) AS cnf_qty,
                                        (SUM(a.tot_qty) - SUM(ifnull(b.cnf_qty, 0))) AS due_qty,
                                        SUM(a.amount) AS del_amount,
                                        ifnull(SUM(b.cnf_qty)*b.rate, 0) AS cnf_amount,
                                        b.rate 
                                        
                                        FROM td_dm_delivery a LEFT JOIN td_dm_confirmation b
                                        ON a.bill_no = b.bill_no
                                        
                                        WHERE a.dist_cd = $dist_cd
                                        AND a.order_no = '$order_no'
                                        
                                        GROUP BY a.bill_no, 
                                                b.rate,
                                                b.cnf_memo) AS t

                                    ");

            return $sql->result();

        }


        public function f_get_totalResult($dist_cd, $item, $form_dt, $to_dt)
        {

         /*   $sql = $this->db->query(" SELECT SUM(a.qty) AS tot_qty, SUM(a.amount) AS tot_amount 
                                    FROM td_dm_delivery a, td_dm_work_order b WHERE a.cnf_status = 1 
                                    AND a.dist_cd = $dist_cd AND a.order_no = b.order_no AND b.item = $item
                                    AND a.del_dt >= '$form_dt' AND a.del_dt <= '$to_dt' "); */
            
            $sql = $this->db->query(" SELECT SUM(a.tot_qty) AS tot_qty, SUM(a.amount) AS tot_amount FROM 
                                    td_dm_delivery a, td_dm_work_order b, md_dm_item c
                                    WHERE a.order_no = b.order_no AND a.dist_cd = b.dist_cd
                                    AND b.item = c.item_no AND a.dist_cd = $dist_cd AND a.cnf_status = 1
                                    AND a.del_dt >= '$form_dt' AND a.del_dt <= '$to_dt' AND b.item = $item ");

            return $sql->result();

        }

        public function f_get_reportItemName($item)
        {

            $sql = $this->db->query(" SELECT item_name FROM md_dm_item WHERE item_no = $item ");
            return $sql->row();

        }

        ////////////////////////////////////////////////////////////////////

        public function js_get_sdoMemo_perOrder($dist_cd, $order_no)
        {

            $sql = $this->db->query(" SELECT DISTINCT sdo_memo FROM td_dm_distribution WHERE order_no = '$order_no'
                                    AND dist_cd = '$dist_cd' ");

            return $sql->result();

        }

        public function js_get_billNo_perMemo($dist_cd, $order_no, $sdo_memo)
        {

            $sql = $this->db->query(" SELECT DISTINCT bill_no FROM td_dm_delivery WHERE order_no = '$order_no'
                                    AND dist_cd = '$dist_cd' AND sdo_memo = '$sdo_memo' ");

            return $sql->result();

        }

        public function js_get_agent_asPer_billNo($dist_cd, $order_no, $sdo_memo, $bill_no)
        {

            $sql = $this->db->query(" SELECT DISTINCT a.point_no, b.agent FROM td_dm_delivery a, md_dist_point b  WHERE a.point_no = b.point_no
            AND a.dist_cd = b.dist_cd  AND a.order_no = '$order_no' AND a.dist_cd = '$dist_cd' AND a.sdo_memo = '$sdo_memo' AND a.bill_no = '$bill_no' ");
                                    
            return $sql->result();

        }

        public function js_agent_allotQty($dist_cd, $order_no, $sdo_memo, $point_no)
        {

            $sql = $this->db->query(" SELECT allot_qty FROM td_dm_distribution WHERE order_no = '$order_no'
                                    AND dist_cd = '$dist_cd' AND sdo_memo = '$sdo_memo' AND point_no = $point_no ");

            return $sql->row();

        }

        public function js_agent_del_totQty($bill_from, $bill_to, $order_no, $sdo_memo, $dist_cd)
        {

            $sql = $this->db->query(" SELECT SUM(tot_qty) tot_qty FROM td_dm_delivery WHERE order_no = '$order_no'
                                    AND sdo_memo = '$sdo_memo' AND dist_cd = $dist_cd AND  bill_no >= $bill_from AND bill_no <= $bill_to ");
                                   
            return $sql->row();

        }

        public function js_agent_del_rate($bill_no, $order_no, $sdo_memo, $point_no)
        {

            $sql = $this->db->query(" SELECT rate FROM td_dm_delivery WHERE order_no = '$order_no'
                                    AND bill_no = '$bill_no' AND sdo_memo = '$sdo_memo' AND point_no = $point_no ");

            return $sql->row();

        }

        public function js_get_previous_cnfDtls($order_no, $bill_no, $sdo_memo, $dist_cd )
        {

            $sql = $this->db->query(" SELECT cnf_dt, cnf_memo, cnf_qty FROM td_dm_confirmation WHERE order_no= '$order_no'
                                    AND  dist_cd= $dist_cd AND sdo_memo = '$sdo_memo' AND bill_no= '$bill_no' ");

            return $sql->result();

        }

        public function confirmation_entry($dist_cd, $order_no, $sdo_memo, $bill_from, $bill_to, $cnf_dt, $cnf_memo, $cnf_qty, $created_by, $created_dt)
        {

            $value = array(
                            'dist_cd' => $dist_cd,
                            'order_no' => $order_no,
                            'sdo_memo' => $sdo_memo,
                            'bill_from' => $bill_from, 
                            'bill_to' => $bill_to, 
                            'cnf_dt' => $cnf_dt,
                            'cnf_memo' => $cnf_memo,
                            'cnf_qty' => $cnf_qty,
                            'created_by' => $created_by,
                            'created_dt' => $created_dt );
                            
                                
            $this->db->insert('td_dm_confirmation',$value);

        }

    // ******************* for accounts section ****************** //
    // ##               controller: Disaster                    ##  //
    // ************************************************************ //


        public function js_get_challanNo_perBill($dist_cd, $order_no, $sdo_memo, $bill_no )
        {

            $sql = $this->db->query(" SELECT GROUP_CONCAT(DISTINCT b.challan_no) AS challan_no FROM td_dm_delivery a, td_dm_delivery_details b
                                    WHERE a.trans_id = b.trans_id AND a.del_dt = b.del_dt AND a.bill_no = b.bill_no
                                    AND a.dist_cd = $dist_cd AND a.order_no = '$order_no'
                                    AND a.sdo_memo = '$sdo_memo' AND b.bill_no = '$bill_no' ");

            return $sql->result();

        }

        public function js_get_bill_districtCode()
        {

            $sql = $this->db->query("SELECT * FROM md_district ORDER BY district_name ");
            return $sql->result();

        }

        public function js_get_cnfQty_Rate($dist_cd, $order_no, $sdo_memo, $bill_no )
        {

            $sql = $this->db->query(" SELECT rate, SUM(tot_qty) AS cnf_qty FROM td_dm_delivery
                                    WHERE dist_cd = $dist_cd AND order_no = '$order_no' AND sdo_memo = '$sdo_memo'
                                    AND bill_no = '$bill_no' GROUP BY dist_cd, order_no, sdo_memo, bill_no, rate ");

            return $sql->result();

        }

        public function js_get_previous_paymentDtls($dist_cd, $order_no, $sdo_memo, $bill_no )
        {

            $sql = $this->db->query(" SELECT payment_dt, trans_mode, part, amount FROM td_dm_bill_payment
                                    WHERE dist_cd = $dist_cd AND order_no = '$order_no' AND sdo_memo = '$sdo_memo' AND bill_no = '$bill_no' ");

            return $sql->result();

        }

        public function f_get_payment_transId($trans_dt)
        {

            $sql = $this->db->query(" SELECT MAX(trans_id) AS trans_id FROM td_dm_bill_payment WHERE 
                                    trans_dt = '$trans_dt' ");

            return $sql->row();

        }

        public function js_get_payment_saleBillDtls($dist_cd, $order_no, $pb_no, $pb_dt)
        {

            $sql = $this->db->query(" SELECT a.amount as pb_amount, b.bill_no as sb_no, b.bill_dt as sb_dt, b.amount as sb_amount
                                    FROM td_dm_delivery a, td_dm_sale b
                                    WHERE a.order_no = b.order_no
                                    AND a.sdo_memo = b.sdo_memo 
                                    AND a.bdo_memo = b.bdo_memo 
                                    AND a.point_no = b.point_no
                                    AND a.challan_from = b.challan_from
                                    AND a.challan_to = b.challan_to 
                                    AND a.bill_no = b.pb_no
                                    AND a.dist_cd = $dist_cd
                                    AND a.order_no = '$order_no'
                                    AND a.bill_no = $pb_no    
                                    AND a.bill_dt = '$pb_dt' ");
            return $sql->result();

        }

        public function f_get_max_slNo_forPayment($memo_no)
        {

            $sql = $this->db->query(" SELECT ifnull(MAX(sl_no),0) as sl_no FROM td_dm_payment WHERE memo_no = '$memo_no' ");
            return $sql->row();

        }

        public function paymentEntry($sl_no, $memo_no, $dist_cd, $order_no, $pb_no, $pb_dt, $pb_amnt, $sb_no, $sb_dt, $sb_amnt, $created_by, $created_dt, $modified_by, $modified_dt,$entry_type, $row)
        {

            for($i=0; $i<$row; $i++)
            {

                $value = array(
                                'sl_no' => $sl_no+$i,
                                'memo_no' => $memo_no,
                                'dist_cd' => $dist_cd[$i],
                                'order_no' => $order_no[$i],
                                'pb_no' => $pb_no[$i],
                                'pb_dt' => $pb_dt[$i],
                                'pb_amount' => $pb_amnt[$i],
                                'sb_no' => $sb_no[$i],
                                'sb_dt' => $sb_dt[$i],
                                'sb_amount' => $sb_amnt[$i],
                                'created_by' => $created_by,
                                'created_dt' => $created_dt,
                                'modified_by' => $modified_by,
                                'modified_dt' => $modified_dt,
                                'entry_type' =>$entry_type);
        
                $this->db->insert('td_dm_payment',$value);

            }

        }

        public function f_get_billPayment_record()
        {

            $sql = $this->db->query(" SELECT DISTINCT memo_no FROM td_dm_payment ");
                                    
             
            return $sql->result();

        }

        public function f_get_payment_editDtls($memo_no)
        {

            $sql = $this->db->query(" SELECT a.order_no, a.dist_cd, b.district_name, a.pb_no, a.pb_dt, a.pb_amount, a.sb_no, a.sb_dt, a.sb_amount
                                    FROM td_dm_payment a, md_district b
                                    WHERE a.dist_cd = b.district_code
                                    AND a.memo_no = '$memo_no' ");
            return $sql->result();

        }

        public function f_delete_billPay($memo_no)
        {

            $sql = $this->db->query(" DELETE FROM td_dm_payment WHERE memo_no = '$memo_no' ");

        }


        // For payment Details entry --
        public function f_get_PaymentDtls()
        {

            $sql = $this->db->query(" SELECT memo_no, mr_no, cr_dt FROM td_dm_paymentdtls ");
            return $sql->result();

        }

        public function f_get_bankDtls()
        {

            $sql = $this->db->query(" SELECT sl_no, bank_name FROM md_bank ");
            return $sql->result();

        }

        public function js_get_billAmnt_formemoNo($memo_no)
        {

            $sql = $this->db->query(" SELECT SUM(sb_amount) as bill_amount, SUM(pb_amount) as pb_amount FROM td_dm_payment WHERE memo_no = '$memo_no' ");
            return $sql->result();

        }

        public function js_check_duplicateMrNo($mr_no)
        {

            $sql = $this->db->query("SELECT COUNT(*) as num_row FROM td_dm_paymentdtls WHERE mr_no = '$mr_no' ");
            return $sql->row();

        }

        public function js_check_duplicateMemoNo($memo_no)
        {

            $sql = $this->db->query(" SELECT COUNT(*) as num_row FROM td_dm_paymentdtls WHERE memo_no = '$memo_no' ");
            return $sql->row();

        }

        public function f_get_paymentMemo()
        {

            $sql = $this->db->query(" SELECT DISTINCT memo_no FROM td_dm_payment ");
            return $sql->result();

        }

        public function f_insert_paymentDtls($value)
        {

            $this->db->insert('td_dm_paymentdtls', $value);

        }

        public function f_get_edit_paymentDtls($memo_no)
        {

            $sql = $this->db->query(" SELECT a.memo_no, a.date, a.mr_no, a.cr_dt, a.bank, a.bill_amount, a.tot_credited, a.commission, a.less,
                                     a.naration, a.tot_payable, a.vendor, a.remarks, b.bank_name
                                    FROM td_dm_paymentdtls a, md_bank b
                                    WHERE a.bank = b.sl_no
                                    AND a.memo_no = '$memo_no' ");
            return $sql->result();

        }

        public function f_get_pbAmount_forpaymentEdit($memo_no)
        {

            $sql = $this->db->query(" SELECT SUM(pb_amount) as pb_amount FROM td_dm_payment WHERE memo_no = '$memo_no' ");
            return $sql->row();

        }

        public function f_update_paymentDtls($value, $memo_no)
        {

            $this->db->where('memo_no', $memo_no);
            $this->db->update('td_dm_paymentdtls', $value);

        }


        public function f_delete_paymentDtlsEntry($memo_no)
        {

            $sql = $this->db->query(" DELETE FROM td_dm_paymentdtls WHERE memo_no = '$memo_no' ");

        }


        // *********** For Accounts Report Section ************* //

        public function f_get_dateWise_billPay_record($startDt, $endDt)
        {

            // $sql = $this->db->query(" SELECT a.trans_dt, a.order_no, c.order_dt, b.district_name,
            //                         a.sdo_memo, a.bill_no, d.del_dt, a.part, a.amount 
            //                         FROM td_dm_bill_payment a, md_district b, td_dm_work_order c, td_dm_delivery d
            //                         WHERE a.dist_cd = b.district_code AND a.order_no = c.order_no AND a.dist_cd = c.dist_cd
            //                         AND a.order_no = d.order_no AND a.dist_cd = d.dist_cd AND a.sdo_memo = d.sdo_memo
            //                         AND a.bill_no = d.bill_no 
            //                         AND a.trans_dt >= '$startDt' AND a.trans_dt <= '$endDt' ");

            $sql = $this->db->query(" SELECT a.mr_no, a.memo_no, a.cr_dt, a.tot_credited, a.commission, a.less, a.tot_payable, b.vendor_name 
                                    FROM td_dm_paymentdtls a, md_sw_vendor b 
                                    WHERE a.vendor = b.sl_no 
                                    AND a.cr_dt >= '$startDt' AND a.cr_dt <= '$endDt' ORDER BY a.cr_dt ");

            return $sql->result();

        }

        public function f_get_dw_tot_billPay_amount($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(tot_credited) AS tot_credited, SUM(commission) AS commission, SUM(less) AS less, SUM(tot_payable) AS tot_payable
                                    FROM td_dm_paymentdtls
                                    WHERE cr_dt >= '$startDt' AND cr_dt <= '$endDt' 
                                    GROUP BY cr_dt ");

            return $sql->result();

        }


    // ********************** For Bill/ Vendor Payment Section *************** //

        public function f_get_vendorPayment_record()
        {

            $sql = $this->db->query(" SELECT a.trans_dt, a.trans_id, a.dist_cd, c.district_name, a.order_no, d.order_dt, a.bill_no, b.del_dt, a.amount
                                    FROM td_dm_vendorPayment a, td_dm_delivery b, md_district c, td_dm_work_order d
                                    WHERE a.dist_cd = b.dist_cd AND a.order_no = b.order_no 
                                    AND a.bill_no = b.bill_no AND a.dist_cd = c.district_code
                                    AND a.dist_cd = d.dist_cd AND a.order_no = d.order_no
                                    ORDER BY a.trans_dt   ");

            return $sql->result();

        }

        public function js_get_billNo_for_vendorPay($dist_cd, $order_no) // FOR JS
        {

            $sql = $this->db->query(" SELECT DISTINCT bill_no, del_dt FROM td_dm_delivery WHERE order_no = '$order_no'
                                    AND dist_cd = '$dist_cd' ");
            return $sql->result();

        }

        public function js_get_Qty_for_vendorPay($dist_cd, $order_no, $bill_no)
        {

            $sql = $this->db->query(" SELECT SUM(tot_qty) AS tot_qty FROM td_dm_delivery
                                    WHERE dist_cd = $dist_cd AND order_no = '$order_no'
                                    AND bill_no = '$bill_no' GROUP BY dist_cd, order_no, bill_no ");

            return $sql->result();

        }

        public function f_get_vendorPay_transId($trans_dt)
        {

            $sql = $this->db->query(" SELECT MAX(trans_id) AS trans_id FROM td_dm_vendorPayment WHERE trans_dt = $trans_dt ");
            return $sql->row();

        }

        public function vendorPayment_entry($trans_dt, $trans_id, $dist_cd, $order_no, $bill_no, $rate, $price, $cgst, $sgst, $amount, $commission, $mode, $bank, $ref_no, $payment_dt, $vendor, $remarks, $created_by, $created_dt )
        {

            $value = array(
                'trans_dt' => $trans_dt,
                'trans_id' => $trans_id,
                'dist_cd' => $dist_cd,
                'order_no' => $order_no,
                'bill_no' => $bill_no,
                'rate' => $rate,
                'price' => $price,
                'cgst' => $cgst,
                'sgst' => $sgst,
                'commission' => $commission,
                'amount' => $amount,
                'bank' => $bank,
                'trans_mode' => $mode,
                'ref_no' => $ref_no,
                'payment_dt' => $payment_dt,
                'vendor' => $vendor,
                'remarks' => $remarks,
                'created_by' => $created_by,
                'created_dt' => $created_dt );
                
                    
            $this->db->insert('td_dm_vendorPayment',$value);

        }

        public function f_delete_vendorPay($trans_dt, $trans_id, $bill_no)
        {
            // echo $trans_dt; echo '/n';
            // echo $trans_id; echo '/n';
            // echo $bill_no; echo '/n';
            // die;

            $this->db->where('trans_dt', $trans_dt);
            $this->db->where('trans_id', $trans_id);
            $this->db->where('bill_no ', $bill_no );

            $this->db->delete('td_dm_vendorPayment');

        }

        ///////// ********************* Report for vendor payment ********************* ///////////

        public function f_get_dateWise_vendorPay_record($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT a.trans_dt, b.district_name, a.order_no, c.order_dt, a.bill_no, d.del_dt, a.price,
                                    a.cgst, a.sgst, a.amount, a.vendor 
                                    FROM td_dm_vendorPayment a, md_district b, td_dm_work_order c, td_dm_delivery d
                                    WHERE a.dist_cd = b.district_code AND a.order_no = c.order_no AND a.dist_cd = c.dist_cd
                                    AND a.order_no = d.order_no AND a.dist_cd = d.dist_cd AND a.bill_no = d.bill_no
                                    AND a.trans_dt >= '$startDt' AND a.trans_dt <= '$endDt' ");
            return $sql->result();
        }

        public function f_get_dw_tot_vendorPay_amount($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(amount) AS tot_amount FROM td_dm_vendorPayment WHERE trans_dt >= '$startDt' AND trans_dt <= '$endDt' ");
            return $sql->row();

        }

        //////// ******************** FOR Revenew Report ******************* ///////

        public function f_get_dateWise_revenewIncome($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(amount) AS income FROM td_dm_bill_payment WHERE trans_dt >= '$startDt' AND trans_dt <= '$endDt' 
                                    GROUP BY trans_dt ");
            return $sql->row();

        }

        public function f_get_dateWise_revenewExpense($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(amount) AS expense, SUM(commission) AS commission FROM td_dm_vendorPayment WHERE trans_dt >= '$startDt' AND trans_dt = '$endDt'
                                    GROUP BY trans_dt ");
            return $sql->result();

        }





    }

?>
