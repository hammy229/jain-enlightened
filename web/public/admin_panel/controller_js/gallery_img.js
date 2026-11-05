$(function () {
     var table = $('#cims_data_table').DataTable({
     processing: false,
     serverSide: true,
     paging: true,
     searching: true,
     destroy: true,
     clear: true,
     
     ajax: base_url + "/admin/gallery/img/data-table",
     columns: [
         { 
             data: 'DT_RowIndex',
             name: 'DT_RowIndex'
         },
         {
          data: 'gallery_img_path',
          name: 'gallery_img_path'
            },
         {
            data: 'description',
            name: 'description'
        },
          {
             data: 'status',
             name: 'status',
             orderable: false,
             searchable: false
         },
         {
             data: 'action',
             name: 'action',
             orderable: false,
             searchable: false
         }
     ]
     });
 
     function reload_table() {
         table.DataTable().ajax.reload(null, false);
     }
 })
 
 