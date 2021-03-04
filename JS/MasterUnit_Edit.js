//This file is about DC edit or delete unit details' script (TableEidt-Plugin) 
$(document).ready(function(){
    $('#manage_table').Tabledit({
        url:'../PHP/UnitManagement_engine.php',
        restoreButton:false,
        eventType:'dblclick',
        deleteButton:true,
        editButton:true,
        columns:{
            identifier:[0,'unit_code'],
            editable:[
                [1,'unit_name'],
                [2,'unit_coordinator'],
                [3,'semester'],
                [4,'campus'],
                [5,'Unit_description']                
            ]
        },
        buttons: {
            edit: {
                class: 'btn btn-sm btn-default',
                html: '<span class="fas fa-edit"></span>',
                action: 'edit'
            },
            delete: {
                class: 'btn btn-sm btn-default',
                html: '<span class="fas fa-eraser"></span>',
                action: 'delete'
            },
            
        },

    });
});




