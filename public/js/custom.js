// 
  $(function() {
    $('#toggle-two').bootstrapToggle({
      on: 'Enabled',
      off: 'Disabled'
    });
  })

// ////////////
  $(function () {
    $("#example1").DataTable();
  });
  $(function () {
    $("#catagory_table").DataTable();
  });

// For View Sellers
  $('.toggle-class').on('change',function(){
    var status = $(this).prop('checked') == true ?1:0;
    var status_id = $(this).data('id');
    $.ajax({
      type:'GET',
      dataType:'JSON',
      url:'/change-padding-status',
      data:{
        'status':status,
        'status_id':status_id
      },
      success:function(data){
        toastr.success(data.success);
      }
    });
  });
///////////////For catagory Delete
function reply_click(clicked_id){
   $.ajax({
      type:'GET',
      dataType:'JSON',
      url:'/delete-catagory',
      data:{
        'id':clicked_id
      },
      success:function(data){
        toastr.success(data.success);
        
       location.reload();
      }
    });
}
//////////////For Section Update
$('.admin-section-status').on('change',function(){
    var status = $(this).prop('checked') == true ?1:0;
    var status_id = $(this).data('id');
    $.ajax({
      type:'GET',
      dataType:'JSON',
      url:'/adminsectionstatus',
      data:{
        'status':status,
        'status_id':status_id
      },
      success:function(data){
        toastr.success(data.success);
      }
    });
});
/////////////For main Catagory
$('#add_cata_section_id,#check_subcatagory').click(function(){
  if($('#check_subcatagory').is(':checked')){
  var cata_section_id = $(this).val();
  $.ajax({
    type:'GET',
    dataType:'JSON',
    url:'getsectionforcata',
    data:{
      'cata_section_id':cata_section_id
    },
    success:function(data){
      $("#cat_parent_id").empty();
      var items = 0;
      items = data.getsectionforcata;
      $.each(items, function (i, item ) {
          $('#cat_parent_id').append($('<option>', { 
              value: item.id,
              text : item.name 
          },'</option>'));
          if(item.subcatagories.length != ''){
            $.each(item.subcatagories, function (j, item ) {
              $('#cat_parent_id').append($('<option>', { 
                value: item.id,
                text : item.name,
                class :'custom-cata-subcata',
              },'</option>'));
            });
          }
          console.log(item.subcatagories);
      });
    }
  });
}else{
  $("#cat_parent_id").empty();
  $('#cat_parent_id').append($('<option>', { 
              value: 0,
              text : 'Main Catagory' 
          }));
}
});
// ///////////////Change Status Catagory////////////
 $('.admin-change-status-cata').on('change',function(){
    var status = $(this).prop('checked') == true ?1:0;
    var status_id = $(this).data('id');
    $.ajax({
      type:'GET',
      dataType:'JSON',
      url:'/admin-change-status-catagory',
      data:{
        'status':status,
        'status_id':status_id
      },
      success:function(data){
        toastr.success(data.success);
      }
    });
  });
// Delete Products////////////
function admin_del_product(clicked_id){
   $.ajax({
      type:'GET',
      dataType:'JSON',
      url:'/delete-product',
      data:{
        'id':clicked_id
      },
      success:function(data){
        $("tr[id="+clicked_id+"]").remove();
        toastr.success(data.success);
       // location.reload();
      }
    });
}