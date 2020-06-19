import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { Router } from '@angular/router';
import { TokenStorageService } from '../../shared/security/token-storage.service';
import { UserService } from '../../../services/user.service';
import { User, UserType } from '../../../domain/user.model';
import { Subscription } from 'rxjs';

@Component({
  selector: 'registration',
  templateUrl: './registration.component.html',
  styleUrls: ['./registration.component.css']
})
export class RegistrationComponent implements OnInit {
  private sub: Subscription;
  private registrationForm: FormGroup;
  private isRegistrationFailed = false;
  private errorMessage = '';
  private userTypes: UserType[] = [UserType.admin, UserType.user];

  constructor(private userService: UserService,
    private router: Router,
    private tokenStorage: TokenStorageService) { }

  ngOnInit() {
    if (this.tokenStorage.getToken()) {
      this.tokenStorage.signOut();
    }
    this.registrationForm = new FormGroup({
        username: new FormControl(),
        password: new FormControl(),
        firstName: new FormControl(),
        lastName: new FormControl(),
        userType: new FormControl(),
        birthDate: new FormControl()
    });
  }

  onSubmit() {
    const user: User = {
      id: null,
      username: this.registrationForm.get('username').value,
      password: this.registrationForm.get('password').value,
      firstName: this.registrationForm.get('firstName').value,
      lastName: this.registrationForm.get('lastName').value,
      userType: this.registrationForm.get('userType').value,
      birthDate: this.registrationForm.get('birthDate').value
    };
    this.userService.register(user)
      .subscribe(
        data => {
          this.router.navigate(['/login']);
        },
        err => {
          this.errorMessage = err.error.message;
          this.isRegistrationFailed = true;
        }
      );
  }

  reloadPage() {
    window.location.reload();
  }
}