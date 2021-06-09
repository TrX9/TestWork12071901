<template>
    <div style="text-align:center">
        <section class="section">
            <div class="container">
                <h1 class="title is-1">League Players ScoreSheet</h1>
                <nav class="navbar" role="navigation" aria-label="main navigation">
                    <div class="navbar-menu">
                        <div class="navbar-item">
                            <router-link to="/" class="navbar-item">Home</router-link>
                            <router-link to="/scoresheet" class="navbar-item">ScoreSheet</router-link>
                            <router-link to="/player" class="navbar-item">Add Player</router-link>
                        </div>
                    </div>
                </nav>
                <router-view></router-view>
            </div>
        </section>
    </div>
</template>

<script>

</script>
