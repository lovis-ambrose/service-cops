import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  private baseUrl = 'https://jsonplaceholder.typicode.com/posts';

  constructor(
    private http: HttpClient,

  ) { }

  getPosts(): Observable<any> {
    return this.http.get(this.baseUrl);
  }

  getPost(id: number): Observable<any> {
    return this.http.get(`${this.baseUrl}/${id}`);
  }

  createPost(post: any): Observable<any> {
    return this.http.post(this.baseUrl, post);
  }

  updatePost(id: number, post: any): Observable<any> {
    return this.http.put(`${this.baseUrl}/${id}`, post);
  }

  deletePost(id: number): Observable<any> {
    return this.http.delete(`${this.baseUrl}/${id}`);
  }
}
