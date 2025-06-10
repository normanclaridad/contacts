<?php
include('inc/app_settings.php');
require_once('inc/helpers.php');
$helpers = new Helpers();

if(!$helpers->checkSession()) {
    $helpers->redirectLogin();
    return;
}

include_once 'templates/header.php';
?>
<style>
    a.btn-delete {
        cursor: pointer;
    }
    .search-area {
        height: 26px;
        margin: 10px;
    }
</style>
    <div class="">
        <div class="search-area">
            <input type="text" id="search" name="search" class="float-end" placeholder="Search">
        </div>
        <div class="" >
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th> NAME </th>
                        <th> COMPANY </th>
                        <th> PHONE </th>
                        <th> EMAIL </th>
                        <th> &nbsp; </th>
                    </tr>
                </thead>
                <tbody id="tbl-data">
                </tbody>
            </table>
        </div>
    </div>
<?php
    include_once 'templates/footer.php';
?>
<script>
    var postData = {
            start : 0,
            length : 10,
            draw: 0
        };
    $(document).ready(function(){
        getData();
        $('#search').keyup(function(){
            var val = $(this).val();  
            // search[value];
            postData.search = {
                value: val           
            }
            
            getData();
        })
    })

    function getData(data = []) {
        
        if(data.legth > 0) {
            
        }

        console.log(postData);

        $.ajax({
            url : 'api/get.php',
            type : 'post',
            data : postData,
            success : function(data) {
                var json = $.parseJSON(data);
                console.log(json['data']);
                tr = formatTableRow(json['data']);
                $('#tbl-data').html(tr);
            }
        });
    }
    $(document).on('click', 'a.btn-delete', function(){
        // console.log($(this).data('id'));
        var id = $(this).data('id');
        var name = $(this).data('name');
        if(confirm('Are you sure you want to delete '+ name +' in our record?')) {
            $.ajax({
            url : 'api/dml.php',
            type : 'post',
            data : {
                id: id,
                action_type: 'delete'
            },
            success : function(data) {
                var json = $.parseJSON(data);
                location.reload();
            }
        });
        }
    })

    function formatTableRow(data) {
        var tr = '';
            $.each(data, function(v, index){
                // console.log(v, index);
                tr += '<tr>';
                tr += '<td>' + index[0] + '</td>';
                tr += '<td>' + index[1] + '</td>';
                tr += '<td>' + index[2] + '</td>';
                tr += '<td>' + index[3] + '</td>';
                tr += '<td>' + index[4] + '</td>';
                tr += '</tr>';
            })
        return tr;
    }
</script>