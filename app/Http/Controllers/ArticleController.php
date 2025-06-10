<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::where('is_published', true);

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Tag filter
        if ($request->filled('tag')) {
            $query->whereJsonContains('tags', $request->tag);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhereJsonContains('tags', $search);
            });
        }

        $articles = $query->orderBy('created_at', 'desc')->paginate(9);
        $categories = Article::where('is_published', true)
            ->distinct()
            ->pluck('category');

        // Get all unique tags for the filter
        $allTags = Article::where('is_published', true)
            ->pluck('tags')
            ->flatten()
            ->unique()
            ->values();

        return view('articles.index', compact('articles', 'categories', 'allTags'));
    }

    public function show(Article $article)
    {
        if (!$article->is_published) {
            abort(404);
        }

        // Get related articles based on category and tags
        $relatedArticles = Article::where('is_published', true)
            ->where('id', '!=', $article->id)
            ->where(function($query) use ($article) {
                $query->where('category', $article->category)
                      ->orWhere(function($q) use ($article) {
                          if ($article->tags) {
                              foreach ($article->tags as $tag) {
                                  $q->orWhereJsonContains('tags', $tag);
                              }
                          }
                      });
            })
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
} 