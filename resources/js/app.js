import './bootstrap';

import Alpine from 'alpinejs';
import 'select2';
import 'select2/dist/js/select2.full.min.js';

import 'select2/dist/css/select2.min.css';
import 'select2';
import Chart from 'chart.js/auto';
import $ from 'jquery';
import {Tabulator} from 'tabulator-tables';
import * as XLSX from 'xlsx';
import SignaturePad from 'signature_pad';


// Ensure jQuery is available globally
window.$ = window.jQuery = $;





window.Alpine = Alpine;

Alpine.start();
window.XLSX = XLSX; 
window.SignaturePad = SignaturePad;



