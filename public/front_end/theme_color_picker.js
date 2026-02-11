(function () {
    'use strict';

    var STORAGE_KEY = 'theme-accent-color';
    var DEFAULT_HEX = '#7c3aed';

    function hexToRgb(hex) {
        var m = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        if (!m) return null;
        return {
            r: parseInt(m[1], 16),
            g: parseInt(m[2], 16),
            b: parseInt(m[3], 16)
        };
    }

    function rgbToHex(r, g, b) {
        return '#' + [r, g, b].map(function (x) {
            x = Math.round(Math.max(0, Math.min(255, x)));
            return ('0' + x.toString(16)).slice(-2);
        }).join('');
    }

    function lighten(hex, amount) {
        var rgb = hexToRgb(hex);
        if (!rgb) return hex;
        return rgbToHex(
            Math.min(255, rgb.r + amount),
            Math.min(255, rgb.g + amount),
            Math.min(255, rgb.b + amount)
        );
    }

    function darken(hex, amount) {
        var rgb = hexToRgb(hex);
        if (!rgb) return hex;
        return rgbToHex(
            Math.max(0, rgb.r - amount),
            Math.max(0, rgb.g - amount),
            Math.max(0, rgb.b - amount)
        );
    }

    function applyTheme(hex) {
        var root = document.documentElement;
        var rgb = hexToRgb(hex);
        if (!rgb) return;

        root.style.setProperty('--accent', hex);
        root.style.setProperty('--accent-rgb', rgb.r + ', ' + rgb.g + ', ' + rgb.b);
        root.style.setProperty('--accent-light', lighten(hex, 25));
        root.style.setProperty('--accent-dark', darken(hex, 30));
    }

    function saveColor(hex) {
        try {
            localStorage.setItem(STORAGE_KEY, hex);
        } catch (e) {}
    }

    function loadColor() {
        try {
            return localStorage.getItem(STORAGE_KEY);
        } catch (e) {
            return null;
        }
    }

    function init() {
        var picker = document.getElementById('theme-color-picker');
        var resetBtn = document.getElementById('theme-color-reset');
        if (!picker) return;

        var saved = loadColor();
        if (saved) {
            picker.value = saved;
            applyTheme(saved);
        }

        picker.addEventListener('input', function () {
            var hex = picker.value;
            applyTheme(hex);
            saveColor(hex);
        });

        picker.addEventListener('change', function () {
            saveColor(picker.value);
        });

        if (resetBtn) {
            resetBtn.addEventListener('click', function () {
                picker.value = DEFAULT_HEX;
                applyTheme(DEFAULT_HEX);
                try { localStorage.removeItem(STORAGE_KEY); } catch (e) {}
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
