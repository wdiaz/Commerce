import tinymce from 'tinymce/tinymce';
import 'tinymce/themes/silver/theme';
import 'tinymce/icons/default/icons';
import 'tinymce/plugins/link';
import 'tinymce/plugins/image';
import 'tinymce/models/dom/model';

// Initialize TinyMCE
tinymce.init({
    base_url: '/build/tinymce',
    selector: '.tinymce-editor', // Target the class for elements to be enhanced by TinyMCE
    plugins: 'link image',
    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | link image',
    license_key: 'gpl',
});