/**
 * class-status.js
 * -----------------------------------------------------------
 * Ye file scheduled classes ke time ko check karti hai aur
 * automatically "Time Over" / "Ongoing" / "Upcoming" status
 * show karti hai — Student aur Teacher dono dashboards pe
 * same file use ho sakti hai.
 *
 * USAGE (Blade template me):
 * <div class="class-card"
 *      data-start-time="{{ $schedule->date->format('Y-m-d') }}T{{ $schedule->start_time->format('H:i:s') }}"
 *      data-end-time="{{ $schedule->date->format('Y-m-d') }}T{{ $schedule->end_time->format('H:i:s') }}">
 *
 *      <h4>{{ $schedule->subject }}</h4>
 *      <span class="time-status"></span>
 * </div>
 *
 * <script src="{{ asset('js/class-status.js') }}"></script>
 * -----------------------------------------------------------
 */

(function () {
    'use strict';

    // Har kitne milliseconds baad status re-check ho (default: 30 seconds)
    const CHECK_INTERVAL_MS = 30000;

    // Status ke labels aur CSS classes — yahan se customize kar sakte hain
    const STATUS_CONFIG = {
        upcoming: {
            label: 'Upcoming',
            icon: '🕒',
            badgeClass: 'badge-secondary'
        },
        ongoing: {
            label: 'Ongoing',
            icon: '🔴',
            badgeClass: 'badge-success'
        },
        time_over: {
            label: 'Time Over',
            icon: '⏱',
            badgeClass: 'badge-danger'
        }
    };

    /**
     * Ek single class-card element ka status determine karta hai
     * aur uske andar .time-status span ko update karta hai.
     */
    function updateCardStatus(card) {
        const startRaw = card.getAttribute('data-start-time');
        const endRaw = card.getAttribute('data-end-time');

        if (!endRaw) {
            console.warn('class-status.js: data-end-time missing on', card);
            return;
        }

        const now = new Date();
        const endTime = new Date(endRaw);
        const startTime = startRaw ? new Date(startRaw) : null;

        let status;
        if (startTime && now < startTime) {
            status = 'upcoming';
        } else if (now >= endTime) {
            status = 'time_over';
        } else {
            status = 'ongoing';
        }

        applyStatus(card, status);
    }

    /**
     * Status ko badge ke through card me visually apply karta hai.
     */
    function applyStatus(card, status) {
        const statusEl = card.querySelector('.time-status');
        if (!statusEl) return;

        // Agar status pehle se same hai to dobara DOM update na karo (perf)
        if (card.dataset.currentStatus === status) return;
        card.dataset.currentStatus = status;

        const config = STATUS_CONFIG[status];

        // Purani badge classes hata kar nayi lagao
        statusEl.className = 'badge time-status ' + config.badgeClass;
        statusEl.innerHTML = config.icon + ' ' + config.label;

        // Card pe ek data attribute bhi set kar dete hain,
        // taake CSS se bhi style kiya ja sake agar chahiye
        card.setAttribute('data-status', status);

        // Custom event dispatch karo — agar koi aur script
        // (e.g. join-button disable/enable) is par react karna chahe
        card.dispatchEvent(new CustomEvent('classStatusChanged', {
            detail: { status: status },
            bubbles: true
        }));
    }

    /**
     * Page ke saare .class-card elements ka status check karta hai
     */
    function checkAllCards() {
        const cards = document.querySelectorAll('.class-card[data-end-time]');
        cards.forEach(updateCardStatus);
    }

    /**
     * Init — page load hone par turant check karo,
     * fir har CHECK_INTERVAL_MS baad repeat karo
     */
    function init() {
        checkAllCards();
        setInterval(checkAllCards, CHECK_INTERVAL_MS);
    }

    // DOM ready hone ka wait karo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Agar dashboard AJAX se naye class-cards inject karta hai
    // (e.g. filter/search ke baad), to manually is function ko
    // call kar sakte hain: window.ClassStatus.refresh()
    window.ClassStatus = {
        refresh: checkAllCards
    };
})();