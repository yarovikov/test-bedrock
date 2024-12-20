<article @php(post_class())>
  <header>
    <h1 class="entry-title">
      {!! esc_html($title ?? '') !!}
    </h1>

  </header>

  <div class="entry-summary">
    @php(the_excerpt())
  </div>
</article>
