<article class="container px-5 py-10">

  @unless(empty($title))
    <h1 class="text-3xl text-center mb-10">{!! esc_html($title) !!}</h1>
  @endunless

  <div class="entry-content max-w-[800px] mx-auto">
    @php(the_content())
  </div>

</article>
