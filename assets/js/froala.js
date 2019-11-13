require('../css/froala.scss');

import $ from 'jquery';

console.log('Hello Froala');




import FroalaEditor from 'froala-editor';
import 'froala-editor/css/froala_editor.pkgd.min.css';
import 'froala-editor/css/froala_style.min.css';

// Load your languages
import 'froala-editor/js/languages/fr.js';

// Load all plugins, or specific ones
import 'froala-editor/js/plugins.pkgd.min.js';
import 'froala-editor/css/plugins.pkgd.min.css';

window.FroalaEditor = FroalaEditor;

// REQUEST AJAX FOR DELETE IMAGE --[+INFOS]--> kms_froala_editor.yaml
/*function froalaImageRemoved($img) {
    $.ajax({
        method: 'POST',
        url: '/admin/blog/delete_image',
        data:{
            src : $img.attr('src')
        }
    })
        .done (function(data){
        console.log('Image supprimé du serveur')
        })
        .fail (function (err){
            console.log('Image delete probleme' + JSON.stringify(err))
        })


        // A descendre tout en bas si ne fonctionne pas
        window.froalaImageRemoved = froalaImageRemoved;


}*/


function froalaDisplayError(p_editor, error ) {
    alert(`Error ${error.code}: ${error.message}`);
}

window.froalaDisplayError = froalaDisplayError;



