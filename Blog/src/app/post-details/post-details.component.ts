import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ApiService } from '../services/api.service';
import { forkJoin } from 'rxjs';

@Component({
  selector: 'app-post-details',
  templateUrl: './post-details.component.html',
  styleUrl: './post-details.component.scss'
})
export class PostDetailsComponent implements OnInit {
  post: any;
  author: any;
  comments: any[] = [];
  photoUrl: string = '';
  thumbnailUrl: string = '';

  constructor(
    private route: ActivatedRoute,
    private postsService: ApiService
  ) {}

  ngOnInit(): void {
    this.route.paramMap.subscribe(params => {
      const postId = params.get('id');
      if (postId) {
        // Fetch post details, comments, author details, and photo concurrently
        forkJoin([
          this.postsService.getPost(+postId),
          this.postsService.getCommentsForPost(+postId),
          this.postsService.getUsers(),
          this.postsService.getPhotoForPost(+postId)
        ]).subscribe(([post, comments, users, photo]) => {
          this.post = post;
          this.comments = comments;
          this.author = users.find((user: any) => user.id === post.userId);
          this.photoUrl = photo.url;
          this.thumbnailUrl = photo.thumbnailUrl;
        });
      }
    });
  }
}
