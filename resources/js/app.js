import './bootstrap';
import 'bootstrap';
import Swal from 'sweetalert2';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import Chart from 'chart.js/auto';
import Alpine from 'alpinejs';

// Expose utilities globally for inline scripts in Blade views
window.Swal = Swal;
window.Calendar = Calendar;
window.dayGridPlugin = dayGridPlugin;
window.interactionPlugin = interactionPlugin;
window.Chart = Chart;

window.Alpine = Alpine;
Alpine.start();
