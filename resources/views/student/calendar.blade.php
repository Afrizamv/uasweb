<x-app-layout>
    @section('title', 'Kalender Tugas')
    @section('page_title', 'Kalender Deadline Tugas')

    <div class="row">
        <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm p-4">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                var calendarEl = document.getElementById('calendar');
                
                var calendar = new window.Calendar(calendarEl, {
                    plugins: [ window.dayGridPlugin, window.interactionPlugin ],
                    initialView: 'dayGridMonth',
                    themeSystem: 'standard',
                    locale: 'id',
                    events: "{{ route('student.calendar.events') }}",
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,dayGridWeek'
                    },
                    eventClick: function(info) {
                        var props = info.event.extendedProps;
                        
                        var badgeColor = 'secondary';
                        if (props.prioritas === 'High') badgeColor = 'danger';
                        else if (props.prioritas === 'Medium') badgeColor = 'warning';

                        var statusBadge = 'secondary';
                        if (props.status === 'Selesai') statusBadge = 'success';
                        else if (props.status === 'Sedang Dikerjakan') statusBadge = 'warning';
                        else if (props.status === 'Terlambat') statusBadge = 'danger';

                        var attachmentHtml = props.lampiran 
                            ? `<p class="mb-0 text-start"><strong>Lampiran:</strong> <a href="${props.lampiran}" target="_blank" class="text-indigo fw-bold text-decoration-none"><i class="bi bi-file-earmark-arrow-down-fill"></i> Download (${props.lampiran_name})</a></p>`
                            : `<p class="mb-0 text-start text-muted"><strong>Lampiran:</strong> Tidak ada file lampiran.</p>`;

                        window.Swal.fire({
                            title: `<div class="text-start border-bottom pb-2 text-dark" style="font-size: 1.25rem; font-weight: 800;">${props.judul}</div>`,
                            html: `
                                <div class="text-start mb-3 mt-2">
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2.5 py-1 small fw-bold text-uppercase mb-2 d-inline-block">${props.subject}</span>
                                    <p class="mb-1 text-secondary" style="font-size: 0.9rem;"><strong>Dosen:</strong> ${props.dosen}</p>
                                    <p class="mb-2 text-secondary" style="font-size: 0.9rem;"><strong>Batas Waktu:</strong> <span class="text-dark fw-semibold"><i class="bi bi-calendar3"></i> ${props.deadline}</span></p>
                                    <div class="d-flex gap-2 mb-3">
                                        <span class="badge bg-${badgeColor}-subtle text-${badgeColor} border border-${badgeColor}-subtle rounded-pill px-2.5 py-1 fw-bold small">Prioritas: ${props.prioritas}</span>
                                        <span class="badge bg-${statusBadge}-subtle text-${statusBadge} border border-${statusBadge}-subtle rounded-pill px-2.5 py-1 fw-bold small">Status: ${props.status}</span>
                                    </div>
                                    <div class="card bg-light border-0 p-3 rounded-3 mb-3">
                                        <p class="mb-0 fw-semibold small text-muted text-uppercase mb-1">Deskripsi:</p>
                                        <p class="mb-0 text-dark small" style="white-space: pre-line;">${props.deskripsi}</p>
                                    </div>
                                    ${attachmentHtml}
                                </div>
                            `,
                            showCloseButton: true,
                            confirmButtonColor: '#6366f1',
                            confirmButtonText: 'Tutup'
                        });
                    }
                });

                calendar.render();
            });
        </script>
    @endpush
</x-app-layout>
