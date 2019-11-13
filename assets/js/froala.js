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


// $(function() {
//     // Catch the image being removed.
//     debugger
//     $('#articles_body').on('FroalaEditor.image.removed', function (e, editor, $img) {
//         console.log('pute pute')
//     })});




window.FroalaEditor = FroalaEditor;

function froalaImageRemoved($img) {
    $.ajax({
        method: 'POST',
        url: '/blog/delete_image',
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
}


function froalaDisplayError(p_editor, error ) {

    console.log("okok");
    return;
    alert(`Error ${error.code}: ${error.message}`);
}

window.froalaDisplayError = froalaDisplayError;
window.froalaImageRemoved = froalaImageRemoved;



