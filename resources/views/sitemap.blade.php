<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<url><loc>{{ url('/') }}</loc><priority>1.0</priority></url>
<url><loc>{{ url('/jobs') }}</loc><priority>0.9</priority></url>
<url><loc>{{ url('/scholarships') }}</loc><priority>0.8</priority></url>
@foreach($jobs as $job)
<url><loc>{{ url('/jobs/'.$job->id) }}</loc><lastmod>{{ $job->updated_at->toAtomString() }}</lastmod></url>
@endforeach
</urlset>