<div x-data="signaturePad(@entangle($attributes->wire('model')))">
    <h1 class="text-xl font-semibold text-gray-700 flex items-center justify-between"><span>Signature pad</span> </h1>
    <div>
        <canvas x-ref="signature_canvas" class="border rounded shadow">

        </canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('signaturePad', (value) => ({
            signaturePadInstance: null,
            value: value,
            init() {
                let canvas = this.$refs.signature_canvas;
                if (typeof SignaturePad !== 'undefined') {
                    this.signaturePadInstance = new SignaturePad(canvas);
                    this.signaturePadInstance.onEnd = () => {
                        this.value = this.signaturePadInstance.toDataURL('image/png');
                        window.Livewire.find('20MdjmWSLHBMZLxqAES2').set('signature', this.value);
                    };
                } else {
                    console.error("SignaturePad is not defined");
                }
            },
            clearSignature() {
                this.signaturePadInstance.clear();
            }
        }));
    });
</script>
