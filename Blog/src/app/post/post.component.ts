import { Component, OnInit } from '@angular/core';
import { ApiService } from '../services/api.service';
import { Observable } from 'rxjs';

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
  currentPage = 1;
  postsPerPage = 8;

  constructor(
    private postsService: ApiService
  ){}


  ngOnInit(): void {
    this.fetchPosts();
  }

  fetchPosts(): void {
    this.postsService.getPosts().subscribe(posts => {
      const startIndex = (this.currentPage - 1) * this.postsPerPage;
      const endIndex = this.currentPage * this.postsPerPage;

      // Split the posts into first, second, and remaining
      this.firstPost = posts[startIndex];
      this.secondPost = posts[startIndex + 1];
      this.remainingPosts = posts.slice(startIndex + 2, endIndex);
    });
  }

  onPageChange(page: number): void {
    this.currentPage = page;
    this.fetchPosts();
  }

  
}
