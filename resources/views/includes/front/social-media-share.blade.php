@php
    $url = urlencode(request()->fullUrl());
@endphp

@push('css')
<style>
    /* Système de partage inline moderne */
    .inline-share-container {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .share-label {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.9rem;
        margin-right: 0.5rem;
        white-space: nowrap;
    }

    .share-buttons-inline {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .share-btn-inline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(179, 177, 88, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 50%;
        text-decoration: none;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        color: #2c3e50;
        cursor: pointer;
        font-size: 0.9rem;
    }

    .share-btn-inline::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.5), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .share-btn-inline:hover::before {
        opacity: 1;
    }

    .share-btn-inline:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        background: rgba(255, 255, 255, 0.95);
        border-color: rgba(179, 177, 88, 0.4);
    }

    .share-btn-inline:active {
        transform: translateY(0) scale(1);
    }

    /* Couleurs spécifiques pour chaque plateforme */
    .facebook-btn:hover {
        background: rgba(24, 119, 242, 0.1);
        border-color: rgba(24, 119, 242, 0.4);
        color: #1877f2;
    }

    .twitter-btn:hover {
        background: rgba(29, 155, 240, 0.1);
        border-color: rgba(29, 155, 240, 0.4);
        color: #1da1f2;
    }

    .linkedin-btn:hover {
        background: rgba(10, 102, 194, 0.1);
        border-color: rgba(10, 102, 194, 0.4);
        color: #0a66c2;
    }

    .whatsapp-btn:hover {
        background: rgba(37, 211, 102, 0.1);
        border-color: rgba(37, 211, 102, 0.4);
        color: #25d366;
    }

    .telegram-btn:hover {
        background: rgba(0, 136, 204, 0.1);
        border-color: rgba(0, 136, 204, 0.4);
        color: #0088cc;
    }

    .email-btn:hover {
        background: rgba(234, 67, 53, 0.1);
        border-color: rgba(234, 67, 53, 0.4);
        color: #ea4335;
    }

    .copy-btn:hover {
        background: rgba(179, 177, 88, 0.1);
        border-color: rgba(179, 177, 88, 0.4);
        color: #b3b158;
    }

    /* Compteur de partages inline */
    .share-counter-inline {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        margin-left: 0.75rem;
        padding: 0.25rem 0.75rem;
        background: rgba(179, 177, 88, 0.1);
        border-radius: 20px;
        font-size: 0.8rem;
        color: #666;
        border: 1px solid rgba(179, 177, 88, 0.2);
        transition: var(--transition);
    }

    .share-counter-inline:hover {
        background: rgba(179, 177, 88, 0.15);
        border-color: rgba(179, 177, 88, 0.3);
    }

    .counter-number-inline {
        font-weight: 700;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 0.85rem;
    }

    .counter-label-inline {
        font-size: 0.75rem;
        color: #888;
    }

    /* Notification de copie adaptée */
    .copy-success-inline {
        position: fixed;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #00b894, #00a085);
        color: white;
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        box-shadow: 0 6px 20px rgba(0, 184, 148, 0.3);
        z-index: 9999;
        transform: translateX(100%);
        opacity: 0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .copy-success-inline.show {
        transform: translateX(0);
        opacity: 1;
    }

    /* Responsive pour mobile */
    @media (max-width: 768px) {
        .inline-share-container {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .share-buttons-inline {
            flex-wrap: wrap;
            gap: 0.4rem;
        }

        .share-btn-inline {
            width: 36px;
            height: 36px;
            font-size: 0.8rem;
        }

        .share-counter-inline {
            margin-left: 0;
            margin-top: 0.25rem;
        }
    }

    /* Animation d'entrée pour les boutons */
    .share-btn-inline {
        animation: slideInUp 0.3s ease-out;
        animation-fill-mode: both;
    }

    .share-btn-inline:nth-child(1) { animation-delay: 0.1s; }
    .share-btn-inline:nth-child(2) { animation-delay: 0.15s; }
    .share-btn-inline:nth-child(3) { animation-delay: 0.2s; }
    .share-btn-inline:nth-child(4) { animation-delay: 0.25s; }
    .share-btn-inline:nth-child(5) { animation-delay: 0.3s; }
    .share-btn-inline:nth-child(6) { animation-delay: 0.35s; }
    .share-btn-inline:nth-child(7) { animation-delay: 0.4s; }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Tooltip pour les boutons */
    .share-btn-inline {
        position: relative;
    }

    .share-btn-inline::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: -35px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.7rem;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
        z-index: 1000;
    }

    .share-btn-inline:hover::after {
        opacity: 1;
    }

    /* Effet de pulse pour attirer l'attention */
    .share-pulse {
        animation: pulse-ring 2s infinite;
    }

    @keyframes pulse-ring {
        0% {
            box-shadow: 0 0 0 0 rgba(179, 177, 88, 0.4);
        }
        50% {
            box-shadow: 0 0 0 8px rgba(179, 177, 88, 0.1);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(179, 177, 88, 0);
        }
    }
</style>
@endpush

<div class="inline-share-container">
    {{-- <span class="share-label">@lang('Share:')</span> --}}

    <div class="share-buttons-inline">
        <!-- Facebook -->
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}"
           target="_blank"
           rel="noopener noreferrer"
           class="share-btn-inline facebook-btn"
           data-tooltip="Facebook"
           onclick="trackShareInline('facebook')">
            <i class="fab fa-facebook-f"></i>
        </a>

        <!-- Twitter -->
        <a href="https://twitter.com/intent/tweet?url={{ $url }}&text={{ urlencode($data->title) }}"
           target="_blank"
           rel="noopener noreferrer"
           class="share-btn-inline twitter-btn"
           data-tooltip="Twitter"
           onclick="trackShareInline('twitter')">
            <i class="fab fa-twitter"></i>
        </a>

        <!-- LinkedIn -->
        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $url }}"
           target="_blank"
           rel="noopener noreferrer"
           class="share-btn-inline linkedin-btn"
           data-tooltip="LinkedIn"
           onclick="trackShareInline('linkedin')">
            <i class="fab fa-linkedin-in"></i>
        </a>

        <!-- WhatsApp -->
        <a href="https://wa.me/?text={{ urlencode($data->title . ' - ' . request()->fullUrl()) }}"
           target="_blank"
           rel="noopener noreferrer"
           class="share-btn-inline whatsapp-btn"
           data-tooltip="WhatsApp"
           onclick="trackShareInline('whatsapp')">
            <i class="fab fa-whatsapp"></i>
        </a>

        <!-- Telegram -->
        <a href="https://t.me/share/url?url={{ $url }}&text={{ urlencode($data->title) }}"
           target="_blank"
           rel="noopener noreferrer"
           class="share-btn-inline telegram-btn"
           data-tooltip="Telegram"
           onclick="trackShareInline('telegram')">
            <i class="fab fa-telegram-plane"></i>
        </a>



        <!-- Copy Link -->
        <button class="share-btn-inline copy-btn"
                data-tooltip="@lang('Copy Link')"
                onclick="copyToClipboardInline('{{ request()->fullUrl() }}')">
            <i class="fas fa-link"></i>
        </button>
    </div>

</div>

@push('js')
<script>
    // Système de partage inline
    document.addEventListener('DOMContentLoaded', function() {
        let shareCountInline = 0;

        // Fonctions de partage inline
        window.trackShareInline = function(platform) {
            shareCountInline++;
            updateShareStatsInline();

            // Effet visuel sur le bouton cliqué
            const clickedBtn = event.target.closest('.share-btn-inline');
            if (clickedBtn) {
                clickedBtn.classList.add('share-pulse');
                setTimeout(() => {
                    clickedBtn.classList.remove('share-pulse');
                }, 2000);
            }

            // Intégration avec le système de notification existant si disponible
            if (typeof showNotification === 'function') {
                showNotification(`Partagé sur ${platform.charAt(0).toUpperCase() + platform.slice(1)}`);
            }

            // Ici vous pouvez ajouter un appel AJAX pour enregistrer le partage
            // fetch('/track-share', { method: 'POST', body: JSON.stringify({ platform }) });
        };

        function updateShareStatsInline() {
            const counter = document.getElementById('shareCounterInline');

            if (counter) {
                counter.textContent = shareCountInline;

                // Animation du compteur
                counter.style.transform = 'scale(1.2)';
                counter.style.color = '#b3b158';
                setTimeout(() => {
                    counter.style.transform = 'scale(1)';
                    counter.style.color = '';
                }, 300);
            }
        }

        window.copyToClipboardInline = function(text) {
            navigator.clipboard.writeText(text).then(() => {
                showCopySuccessInline();
                trackShareInline('copy');

                // Changer l'icône temporairement
                const copyBtn = event.target.closest('.copy-btn');
                const icon = copyBtn.querySelector('i');
                const originalClass = icon.className;
                icon.className = 'fas fa-check';
                setTimeout(() => {
                    icon.className = originalClass;
                }, 2000);

            }).catch(() => {
                // Fallback pour les navigateurs plus anciens
                const textArea = document.createElement('textarea');
                textArea.value = text;
                textArea.style.position = 'fixed';
                textArea.style.left = '-999999px';
                textArea.style.top = '-999999px';
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                showCopySuccessInline();
                trackShareInline('copy');
            });
        };

        function showCopySuccessInline() {
            const notification = document.createElement('div');
            notification.className = 'copy-success-inline';
            notification.innerHTML = '<i class="fas fa-check"></i> @lang("Lien copié avec succès !")';
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.classList.add('show');
            }, 100);

            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        // Initialisation - vous pouvez charger les statistiques existantes ici
        // fetch('/get-share-stats').then(response => response.json()).then(data => {
        //     shareCountInline = data.count;
        //     updateShareStatsInline();
        // });

        // Effet de hover pour le compteur
        const counter = document.querySelector('.share-counter-inline');
        if (counter) {
            counter.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05)';
            });
            counter.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        }
    });
</script>
@endpush
