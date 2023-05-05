import './bootstrap';

import Alpine from 'alpinejs';
import flatpickr from "flatpickr";
import Quill from "quill";
import * as FilePond from "filepond";
import focus from '@alpinejs/focus';
import 'flowbite';
import 'flowbite-typography';
import Swal from "sweetalert2/dist/sweetalert2";

Alpine.plugin(focus);

window.flatpickr = flatpickr;
window.FilePond = FilePond;
window.Quill = Quill;
window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();

import "@fortawesome/fontawesome-free/css/all.css";
import "@sweetalert2/theme-dark/dark.min.css";
