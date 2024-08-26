import { Component, OnInit } from '@angular/core';
import { ApiService } from '../services/api.service';
import { PageEvent } from '@angular/material/paginator';  // Import PageEvent

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
  postsPerPage = 8;
  totalPosts = 100;
  selectedPost: any;

  constructor(
    private postsService: ApiService
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
    });
  }

  onPageChange(event: PageEvent): void {
    this.currentPage = event.pageIndex;
    this.postsPerPage = event.pageSize;
    this.fetchPosts();
  }

  viewPost(postId: number): void {
    this.postsService.getPost(postId).subscribe(post => {
      this.selectedPost = post;
      // Optionally, you can also redirect to a new page or display a modal
    });
  }

}
