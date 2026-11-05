$(function () {
     var table = $('#cims_data_table').DataTable({
          processing: false,
          serverSide: true,
          paging: true,
          searching: true,
          destroy: true,
          clear: true,
         
         ajax: base_url + "/admin/internship-enquiry/data-table",
         columns: [{
             data: 'DT_RowIndex',
             name: 'DT_RowIndex'
         },
         { 
          data: 'select',
          name: 'select',
          orderable: false,
          searchable: false,
           }, 
           {
               data: 'created_at',
               name: 'created_at'
         },
         {
             data: 'name',
             name: 'name'
         },
         {
             data: 'email',
             name: 'email'
         },
         {
          data: 'mobile_no',
          name: 'mobile_no'
       },
      {
          data: 'position',
          name: 'position'
      },
         {
             data: 'action',
             name: 'action',
             orderable: false,
             searchable: false
         },
         ]
     });
 
     function reload_table() {
         table.DataTable().ajax.reload(null, false);
     }
 })