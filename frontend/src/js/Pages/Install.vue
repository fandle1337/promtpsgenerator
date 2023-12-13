<template>
    <div class="d-flex flex-column mt-5">
        <div class="text-center mb-3" style="font-size: 64px">
            <b>Поздравляем</b>
        </div>
        <div class="text-center mb-5" style="font-size: 35px; text-transform: uppercase">
            Приложение успешно установлено
        </div>
        <div class="d-flex justify-content-center">
            <button :class="['ui-btn', 'ui-btn-success', {'ui-btn-wait': isLoad}]"  @click="installApp">Начать работу</button>
        </div>
    </div>
</template>

<script>

import RequestBuilder from "../class/RequestBuilder";
import confetti from "canvas-confetti";

export default {
    data()
    {
        return {
            isLoad: true,
        }
    },
    props: {
        paramList: {
            type: Object,
            default: () => {
                return {}
            }
        }
    },
    methods: {
        installApp()
        {
            if(!this.isLoad) {
                BX24.installFinish();
            }

        },
    },
    async mounted()
    {
        (new RequestBuilder(AUTH_OBJECT)).fetch("/api/install/", {
            method: 'POST',
        }).then(e => {
            this.isLoad = false;
        });

        confetti({
            spread: 70,
            particleCount: 120,
            origin: {
                y: 0.5,
                x: 0.5
            }
        })
    },
}
</script>

<style>

</style>