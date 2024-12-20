<header class="site-header">
  <div class="container text-center">
    @unless(empty($nav_items))
      @includeIf('sections.header.header-nav')
    @endunless
  </div>
</header>
