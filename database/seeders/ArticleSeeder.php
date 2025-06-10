<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $articles = [
            [
                'title' => 'Understanding Stock Market Basics for Beginners',
                'content' => '<h2>Introduction to Stock Market</h2>
                    <p>The stock market can seem intimidating for beginners, but understanding the basics is crucial for building wealth. This guide will walk you through the fundamental concepts of stock market investing.</p>
                    
                    <h3>What is the Stock Market?</h3>
                    <p>The stock market is a marketplace where shares of publicly traded companies are bought and sold. When you buy a stock, you\'re purchasing a small piece of ownership in that company.</p>
                    
                    <h3>Key Terms to Know</h3>
                    <ul>
                        <li><strong>Stock:</strong> A share of ownership in a company</li>
                        <li><strong>Dividend:</strong> A portion of company profits paid to shareholders</li>
                        <li><strong>Bull Market:</strong> A period of rising stock prices</li>
                        <li><strong>Bear Market:</strong> A period of falling stock prices</li>
                    </ul>
                    
                    <h3>Getting Started</h3>
                    <p>Before investing, it\'s important to:</p>
                    <ol>
                        <li>Set clear financial goals</li>
                        <li>Understand your risk tolerance</li>
                        <li>Research companies thoroughly</li>
                        <li>Diversify your portfolio</li>
                    </ol>',
                'category' => 'Investment',
                'image_url' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'author' => 'Financial Expert',
                'is_published' => true,
                'reading_time' => 8,
                'tags' => ['stocks', 'investing', 'beginners', 'market basics'],
            ],
            [
                'title' => 'Essential Tax Planning Strategies for 2024',
                'content' => '<h2>Tax Planning Guide 2024</h2>
                    <p>Effective tax planning is crucial for maximizing your financial returns. This comprehensive guide covers essential strategies for the 2024 tax year.</p>
                    
                    <h3>Key Tax Changes for 2024</h3>
                    <p>Understanding the latest tax regulations is essential for proper planning. Here are some important changes to note:</p>
                    <ul>
                        <li>Updated tax brackets and rates</li>
                        <li>New deduction limits</li>
                        <li>Changes in retirement contribution limits</li>
                    </ul>
                    
                    <h3>Tax Planning Strategies</h3>
                    <ol>
                        <li>Maximize retirement contributions</li>
                        <li>Utilize tax-advantaged accounts</li>
                        <li>Consider tax-loss harvesting</li>
                        <li>Plan charitable contributions</li>
                    </ol>',
                'category' => 'Tax',
                'image_url' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'author' => 'Tax Specialist',
                'is_published' => true,
                'reading_time' => 10,
                'tags' => ['tax planning', '2024 taxes', 'deductions', 'retirement'],
            ],
            [
                'title' => 'Building Your Emergency Fund: A Step-by-Step Guide',
                'content' => '<h2>Emergency Fund Essentials</h2>
                    <p>An emergency fund is a crucial component of financial security. This guide will help you build and maintain an effective emergency fund.</p>
                    
                    <h3>Why You Need an Emergency Fund</h3>
                    <p>An emergency fund provides a financial safety net for unexpected expenses such as:</p>
                    <ul>
                        <li>Medical emergencies</li>
                        <li>Job loss</li>
                        <li>Major home repairs</li>
                        <li>Car repairs</li>
                    </ul>
                    
                    <h3>How to Build Your Emergency Fund</h3>
                    <ol>
                        <li>Set a target amount (3-6 months of expenses)</li>
                        <li>Create a monthly savings plan</li>
                        <li>Automate your savings</li>
                        <li>Keep the fund in a high-yield savings account</li>
                    </ol>',
                'category' => 'Cash Flow',
                'image_url' => 'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'author' => 'Financial Advisor',
                'is_published' => true,
                'reading_time' => 6,
                'tags' => ['emergency fund', 'savings', 'financial security', 'budgeting'],
            ],
            [
                'title' => 'Digital Marketing Strategies for Financial Advisors',
                'content' => '<h2>Digital Marketing in Finance</h2>
                    <p>In today\'s digital age, effective marketing is essential for financial advisors. This guide explores modern digital marketing strategies for financial professionals.</p>
                    
                    <h3>Key Digital Marketing Channels</h3>
                    <ul>
                        <li>Social Media Marketing</li>
                        <li>Content Marketing</li>
                        <li>Email Marketing</li>
                        <li>Search Engine Optimization (SEO)</li>
                    </ul>
                    
                    <h3>Building Your Online Presence</h3>
                    <p>To establish a strong online presence:</p>
                    <ol>
                        <li>Create valuable, educational content</li>
                        <li>Engage with your audience on social media</li>
                        <li>Build an email list</li>
                        <li>Optimize your website for search engines</li>
                    </ol>',
                'category' => 'Marketing',
                'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'author' => 'Marketing Expert',
                'is_published' => true,
                'reading_time' => 7,
                'tags' => ['digital marketing', 'financial advisors', 'social media', 'content marketing'],
            ],
            [
                'title' => 'Cryptocurrency Investment: A Comprehensive Guide',
                'content' => '<h2>Understanding Cryptocurrency</h2>
                    <p>Cryptocurrency has emerged as a new asset class that investors can\'t ignore. This guide will help you understand the basics of crypto investing and how to approach it safely.</p>
                    
                    <h3>What is Cryptocurrency?</h3>
                    <p>Cryptocurrency is a digital or virtual currency that uses cryptography for security. Bitcoin, Ethereum, and other cryptocurrencies operate on blockchain technology.</p>
                    
                    <h3>Key Considerations for Crypto Investment</h3>
                    <ul>
                        <li>Understanding blockchain technology</li>
                        <li>Risk management strategies</li>
                        <li>Market volatility factors</li>
                        <li>Regulatory considerations</li>
                    </ul>
                    
                    <h3>Getting Started with Crypto</h3>
                    <ol>
                        <li>Research different cryptocurrencies</li>
                        <li>Choose a reliable exchange</li>
                        <li>Start with a small investment</li>
                        <li>Secure your digital assets</li>
                    </ol>',
                'category' => 'Investment',
                'image_url' => 'https://images.unsplash.com/photo-1621761191319-c6fb62004040?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'author' => 'Crypto Analyst',
                'is_published' => true,
                'reading_time' => 12,
                'tags' => ['cryptocurrency', 'blockchain', 'digital assets', 'crypto investing'],
            ],
            [
                'title' => 'Retirement Planning: Building Your Nest Egg',
                'content' => '<h2>Planning for Retirement</h2>
                    <p>Retirement planning is crucial for ensuring financial security in your golden years. This comprehensive guide will help you create and maintain a solid retirement strategy.</p>
                    
                    <h3>Key Components of Retirement Planning</h3>
                    <ul>
                        <li>Social Security benefits</li>
                        <li>Employer-sponsored retirement plans</li>
                        <li>Individual retirement accounts (IRAs)</li>
                        <li>Investment portfolio management</li>
                    </ul>
                    
                    <h3>Steps to a Secure Retirement</h3>
                    <ol>
                        <li>Calculate your retirement needs</li>
                        <li>Maximize your retirement contributions</li>
                        <li>Diversify your investments</li>
                        <li>Plan for healthcare costs</li>
                    </ol>',
                'category' => 'Investment',
                'image_url' => 'https://images.unsplash.com/photo-1573497620053-ea5300f94f21?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'author' => 'Retirement Specialist',
                'is_published' => true,
                'reading_time' => 9,
                'tags' => ['retirement', 'pension', '401k', 'financial planning'],
            ],
            [
                'title' => 'Small Business Financial Management',
                'content' => '<h2>Financial Management for Small Businesses</h2>
                    <p>Effective financial management is crucial for small business success. This guide covers essential strategies for managing your business finances effectively.</p>
                    
                    <h3>Key Financial Management Areas</h3>
                    <ul>
                        <li>Cash flow management</li>
                        <li>Budgeting and forecasting</li>
                        <li>Tax planning and compliance</li>
                        <li>Financial reporting and analysis</li>
                    </ul>
                    
                    <h3>Best Practices for Small Business Finance</h3>
                    <ol>
                        <li>Maintain accurate financial records</li>
                        <li>Monitor cash flow regularly</li>
                        <li>Plan for tax obligations</li>
                        <li>Build emergency reserves</li>
                    </ol>',
                'category' => 'Business',
                'image_url' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'author' => 'Business Consultant',
                'is_published' => true,
                'reading_time' => 11,
                'tags' => ['small business', 'financial management', 'business finance', 'cash flow'],
            ],
            [
                'title' => 'Sustainable Investing: A Guide to ESG',
                'content' => '<h2>Understanding ESG Investing</h2>
                    <p>Environmental, Social, and Governance (ESG) investing is gaining momentum as investors seek to align their portfolios with their values. Learn how to incorporate ESG principles into your investment strategy.</p>
                    
                    <h3>Components of ESG Investing</h3>
                    <ul>
                        <li>Environmental factors</li>
                        <li>Social responsibility</li>
                        <li>Corporate governance</li>
                        <li>Impact measurement</li>
                    </ul>
                    
                    <h3>Getting Started with ESG Investing</h3>
                    <ol>
                        <li>Define your ESG priorities</li>
                        <li>Research ESG funds and companies</li>
                        <li>Evaluate ESG ratings and reports</li>
                        <li>Monitor impact and performance</li>
                    </ol>',
                'category' => 'Investment',
                'image_url' => 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'author' => 'ESG Investment Analyst',
                'is_published' => true,
                'reading_time' => 10,
                'tags' => ['ESG', 'sustainable investing', 'impact investing', 'green finance'],
            ],
            [
                'title' => 'New Article Title',
                'content' => '<h2>New Article Title</h2>
                    <p>New article content goes here.</p>',
                'category' => 'New Category',
                'image_url' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'author' => 'New Author',
                'is_published' => true,
                'reading_time' => 5,
                'tags' => ['new', 'article', 'content'],
            ]
        ];

        foreach ($articles as $articleData) {
            $slug = Str::slug($articleData['title']);
            
            Article::updateOrCreate(
                ['slug' => $slug],
                $articleData
            );
        }
    }
} 