$(document).ready(function(){
    var spk   = $('#txtSPK').val();

    $('#formJudul').on('submit', function(event){
        event.preventDefault();

        if($(this).parsley().validate()){
            
            var spk   = $('#txtSPK').val();
            var id    = $('#txtID').val();
            var judul = $('#txtJudul').val();
            
            $.ajax({
                url : 'php/ajx/crudJob.php?type=addJudul',
                type: 'post',
                data: 'spk='+spk+'&judul='+judul+'&id='+id,
                
                success : function(msg){
                    if(msg != ''){
                        alert(msg);
                        location.reload();
                        $('#formJudul #txtJudul').val('');
                        $( "#listPanel" ).load( "?p=add-list-job&name="+spk+" #listPanel" );
                        $( "#formJudul1" ).load( "?p=add-list-job&name="+spk+" #formJudul1" );
                    }
                    
                }
            });
        }
        else{
            alert('System Error');
        }
    });

    $('#detailJob').on('submit', function(event){
        event.preventDefault();

        if($(this).parsley().validate()){
            var spk   = $('#txtSPK').val();
            var kode = $('#txtKodeDetail').val();
            var admin = $('#txtAdmin').val();   
            var kegiatan = $('#txtKegiatan').val();
            var deskripsi = $('#txtDeskripsi').val();
            var keterangan = $('#txtKeterangan').val();

            $.ajax({
                url : 'php/ajx/crudJob.php?type=addDetail',
                type: 'post',
                data: 'kode='+kode+'&admin='+admin+'&kegiatan='+kegiatan+'&deskripsi='+deskripsi+'&keterangan='+keterangan,
                
                success : function(msg){
                    if(msg != ''){
                        alert(msg);
                        location.reload();
                        $( "#listPanel" ).load("?p=add-list-job&name="+spk+" #listPanel");
                        $('#detailJob').load("?p=add-list-job&name="+spk+" #detailJob");
                        $('#tableDetail').load("?p=add-list-job&name="+spk+" #tableDetail");
                    }
                    
                }
            })

        }
        else{
            alert('Hello data pelanggan yang amat sulit kita jalani');
        }
    });

    $('#removeDetail').click(function(){
            var id = $(this).data('id');
            
            $.ajax({
                url : 'php/ajx/crudJob.php?type=deleteDetail',
                type: 'post',
                data: 'id='+id,
                
                success : function(msg){
                    if(msg != ''){
                        alert(msg);
                        location.reload();
                        
                        $( "#listPanel" ).load("?p=add-list-job&name="+spk+" #listPanel");
                        $('#detailJob').load("?p=add-list-job&name="+spk+" #detailJob");
                    }
                    
                }
            })
    });

    $('#removeTitle').click(function(){
        var id = $(this).data('id');
        
        $.ajax({
            url : 'php/ajx/crudJob.php?type=deleteTitle',
            type: 'post',
            data: 'id='+id,
            
            success : function(msg){
                if(msg != ''){
                    alert(msg);
                    location.reload();
                    $( "#listPanel" ).load("?p=add-list-job&name="+spk+" #listPanel");
                    $('#detailJob').load("?p=add-list-job&name="+spk+" #detailJob");
                }
                
            }
        })
});
    
})