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

function froalaDisplayError(p_editor, error ) {
    alert(`Error ${error.code}: ${error.message}`);
}

window.froalaDisplayError = froalaDisplayError;


