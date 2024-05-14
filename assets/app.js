import { registerReactControllerComponents } from '@symfony/ux-react';
import './bootstrap.js';
import './css/app.css';

import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import Dropzone from "dropzone";

const $  = require("jquery");
window.$ = $;



Dropzone.autoDiscover = false;

registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));