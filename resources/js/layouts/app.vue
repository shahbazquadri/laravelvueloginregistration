<template>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
          <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                       <router-link to="/" class="nav-link">Home</router-link>
                    </li>
                    <li class="nav-item">
                       <router-link to="/Login" class="nav-link">Login</router-link>
                    </li>
                    <li class="nav-item">
                       <router-link to="/Register" class="nav-link">Register</router-link>
                    </li>
                    
                  
                </ul>
            
            </div>
      </div>
    </nav>
    
<router-view></router-view>
</template>

