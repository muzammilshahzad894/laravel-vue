<template>
    <div class="container-scroller">
        <Header/>
        <div class="container-fluid page-body-wrapper">
            <Aside/>
            <div class="main-panel">
                <div class="content-wrapper">
                    <router-view/>
                </div>
                <Footer/>
            </div>
        </div>
    </div>
</template>

<script>
import Header from "../components/layout/Header.vue"
import Aside from "../components/layout/Aside.vue"
import Footer from "../components/layout/Footer.vue"

export default {
    name: "Layout",
    components: {Footer, Aside, Header}
}
</script>