import './bootstrap';

import Alpine from 'alpinejs';
import flatpickr from "flatpickr";
import Quill from "quill";
import * as FilePond from "filepond";
import focus from '@alpinejs/focus';
import 'flowbite';
import 'flowbite-typography';

Alpine.plugin(focus);

window.flatpickr = flatpickr;
window.FilePond = FilePond;
window.Quill = Quill;
window.Alpine = Alpine;

Alpine.start();

import "@fortawesome/fontawesome-free/css/all.css";
