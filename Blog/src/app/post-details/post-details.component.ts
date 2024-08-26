import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ApiService } from '../services/api.service';

@Component({
  selector: 'app-post-details',
  templateUrl: './post-details.component.html',
  styleUrl: './post-details.component.scss'
})
export class PostDetailsComponent implements OnInit{

  post: any;

  constructor(
    private route: ActivatedRoute,
    private apiService: ApiService
  ) {}

  
  ngOnInit(): void {
    this.fetchPost();
  }

  fetchPost(): void {
    const postId = this.route.snapshot.paramMap.get('id');
    if (postId) {
      this.apiService.getPost(+postId).subscribe(post => {
        this.post = post;
      });
    }
  }

}
