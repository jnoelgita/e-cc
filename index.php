<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>E-Citizen's Charter</title>

	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/fresh-bootstrap-table.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        
</head>
<body>

<div class="wrapper">

    <div class="row">
        <div class="col-lg-12" style="background-color: #ff0000;">
            <center> <img src="assets/img/logo_cc.png" style="height:120px;" /> </center>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="background-color: #ffdd00;">
            <center> <img src="assets/img/header_cc.png" style="height:120px;" /> </center>
        </div>
    </div>

    <div class="fresh-table full-color-red full-screen-table">
    <!--    Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange                  
            Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
    -->
        
        <div class="toolbar">
           <h3 style="text-align: center;"> Frontline Services </h3>
        </div>
        
        <table id="frontlist" class="table">
                <thead>
                    
                    <th data-field="f_name" style="text-align: center; width: 70%;" data-sortable="true">Frontline Service</th>
                    <th data-field="f_unit" style="text-align: center; width: 25%;" data-sortable="true">Office Concerned</th>
                                        
                    <th data-field="actions" data-events="operateEvents"> Actions </th>
                </thead>
                <tbody>
                    <?php 
                        include "connect.php";
                            $result = mysqli_query($con,"SELECT * FROM frontline ORDER BY f_id ASC");
                            while($row= mysqli_fetch_array($result)){ 
                                $f_id=$row["f_id"];
                                $f_name=$row["f_name"];
                                $f_unit=$row["f_unit"];
                    ?>

                        <tr>
                            <td> <?php echo $f_name; ?> </td>
                            <td><?php  echo $f_unit; ?></td>
                            <td> <a class="btn btn-md btn-success" href="<?php echo 'f_img/' . $f_id . '.pdf'; ?>" target="_blank"> View </a> </td>
                        </tr>

                    <?php
                            }
                                
                            
                    ?>
                    
                    
                </tbody>
            </table>
    </div>
    <div class="footer" style="background-color:#ffdd00; color: #ff0000; padding: 30px 0 60px;">
            <div class="container">
                <b class="copyright"> Adopted by: DepEd Malolos City-ICT Unit. Copyright.&copy; <script>document.write(new Date().getFullYear())</script> </b>All rights reserved.
            </div>
    </div>
</div>


</body>
    <script type="text/javascript" src="assets/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-table.js"></script>
        
    <script type="text/javascript">
        var $table = $('#frontlist'),
            $alertBtn = $('#alertBtn'), 
            full_screen = false,
            window_height;
            
        $().ready(function(){
            
            window_height = $(window).height();
            table_height = window_height - 20;
            
            
            $table.bootstrapTable({
                toolbar: ".toolbar",

                showRefresh: false,
                search: true,
                showToggle: false,
                showColumns: false,
                pagination: false,
                striped: true,
                sortable: true,
                height: table_height,
                pageSize: 40,
                pageList: [40,50,100],
                
                formatShowingRows: function(pageFrom, pageTo, totalRows){
                    //do nothing here, we don't want to show the text "showing x of y from..." 
                },
                formatRecordsPerPage: function(pageNumber){
                    return pageNumber + " rows visible";
                },
                icons: {
                    refresh: 'fa fa-refresh',
                    toggle: 'fa fa-th-list',
                    columns: 'fa fa-columns',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'fa fa-minus-circle'
                }
            });
            
            window.operateEvents = {
                'click .like': function (e, value, row, index) {
                    alert('You click like icon, row: ' + JSON.stringify(row));
                    console.log(value, row, index);
                },
                'click .edit': function (e, value, row, index) {
                    alert('You click edit icon, row: ' + JSON.stringify(row));
                    console.log(value, row, index);    
                },
                'click .remove': function (e, value, row, index) {
                    $table.bootstrapTable('remove', {
                        field: 'id',
                        values: [row.id]
                    });
            
                }
            };
            
            $alertBtn.click(function () {
                alert("You pressed on Alert");
            });
        
            
            $(window).resize(function () {
                $table.bootstrapTable('resetView');
            });    
        });
        

        /* function operateFormatter(value, row, index) {
            return [
                '<a rel="tooltip" title="Like" class="table-action like" href="javascript:void(0)" title="Like">',
                    '<i class="fa fa-heart"></i>',
                '</a>',
                '<a rel="tooltip" title="Edit" class="table-action edit" href="javascript:void(0)" title="Edit">',
                    '<i class="fa fa-edit"></i>',
                '</a>',
                '<a rel="tooltip" title="Remove" class="table-action remove" href="javascript:void(0)" title="Remove">',
                    '<i class="fa fa-remove"></i>',
                '</a>'
            ].join('');
        } */
       
    </script>

</html>