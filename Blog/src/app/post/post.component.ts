  import { Component, OnInit } from '@angular/core';
  import { ApiService } from '../services/api.service';
  import { PageEvent } from '@angular/material/paginator';
  import { Router } from '@angular/router';

  @Component({
    selector: 'app-post',
    templateUrl: './post.component.html',
    styleUrl: './post.component.scss'
  })
  export class PostComponent implements OnInit {

    posts: any[] = [];
    firstPost: any;
    secondPost: any;
    remainingPosts: any[] = [];
    currentPage = 0;
    postsPerPage = 10;
    totalPosts = 100;

    constructor(
      private postsService: ApiService,
      private router: Router
    ) {}

    ngOnInit(): void {
      this.fetchPosts();
    }

    fetchPosts(): void {
      this.postsService.getPosts().subscribe(posts => {
        const startIndex = this.currentPage * this.postsPerPage;
        const endIndex = startIndex + this.postsPerPage;

        // Split the posts into first, second, and remaining
        this.firstPost = posts[startIndex];
        this.secondPost = posts[startIndex + 1];
        this.remainingPosts = posts.slice(startIndex + 2, endIndex);

        // Fetch photos for first and second posts
        this.fetchPostPhoto(this.firstPost);
        this.fetchPostPhoto(this.secondPost);
        this.remainingPosts.forEach(post => this.fetchPostPhoto(post));
      });
    }

    fetchPostPhoto(post: any): void {
      if (post) {
        this.postsService.getPhotoForPost(post.id).subscribe(photo => {
          post.photoUrl = photo?.url || 'https://via.placeholder.com/300x200';  // Set default placeholder
        });
      }
    }

    onPageChange(event: PageEvent): void {
      this.currentPage = event.pageIndex;
      this.postsPerPage = event.pageSize;
      this.fetchPosts();
    }

    viewPost(postId: number): void {
      this.router.navigate([`/posts/${postId}`]);
    }    
  }
