import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  private postsUrl = 'https://jsonplaceholder.typicode.com/posts';
  private photosUrl = 'https://jsonplaceholder.typicode.com/photos';
  private commentsUrl = 'https://jsonplaceholder.typicode.com/posts/1/comments';

  constructor(
    private http: HttpClient,

  ) { }

  getPosts(): Observable<any> {
    return this.http.get(this.postsUrl);
  }
  
  createPost(post: any): Observable<any> {
    return this.http.post(this.postsUrl, post);
  }

  updatePost(id: number, post: any): Observable<any> {
    return this.http.put(`${this.postsUrl}/${id}`, post);
  }

  deletePost(id: number): Observable<any> {
    return this.http.delete(`${this.postsUrl}/${id}`);
  }

  getPost(postId: number): Observable<any> {
    return this.http.get(`${this.postsUrl}/${postId}`);
  }
  getCommentsForPost(postId: number): Observable<any> {
    return this.http.get(`https://jsonplaceholder.typicode.com/comments?postId=${postId}`);
  }

  getUsers(): Observable<any> {
    return this.http.get('https://jsonplaceholder.typicode.com/users');
  }

  getPhotoForPost(postId: number): Observable<any> {
    return this.http.get(`https://jsonplaceholder.typicode.com/photos/${postId}`);
  }
}
