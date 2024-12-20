<div class="container mx-auto px-5 py-10">

  <div class=" flex flex-col lg:flex-row gap-8">
    <div class="flex-1">
      @php(the_content())
    </div>

    @if(true === ($is_sidebar ?? false))
      @includeIf('partials.sidebar')
    @endif
  </div>

</div>
