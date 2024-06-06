import './bootstrap.js';
import { registerReactControllerComponents } from '@symfony/ux-react';

import './css/app.css';

registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));