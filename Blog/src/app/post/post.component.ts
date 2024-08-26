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
  currentPage = 1;
  totalPosts = 0;
  postsPerPage = 10;

  constructor(
    private postsService: ApiService
  ){}


  ngOnInit(): void {
    this.fetchPosts();
  }

  fetchPosts(): void {
    this.postsService.getPosts().subscribe(posts => {
      console.log(posts);
      this.totalPosts = posts.length;
      this.posts = posts.slice((this.currentPage - 1) * this.postsPerPage, this.currentPage * this.postsPerPage);
    });
  }

  onPageChange(page: number): void {
    this.currentPage = page;
    this.fetchPosts();
  }

  
}
